import pandas as pd
from path import Path
import sqlalchemy as sql

import pandas as pd
import os
import json
import sys
import time
import hmac
import requests
from api_data.ftx_functions import (get_price,get_historical_data)

#
# Get the market data from the FTX exchange using the API calls 
# This function was originally written to read the data from a csv file. However, it has been enhanced to retrieving data from database.
# The old code is still maintained and commented for future use
# 
# This function scans the FTX exchange, retrieves data for BTC and ETH.
# It retrieves SPOT price and two FUTURE prices (March futures and June futures)
# It then identifies the best arb trade. 
# The function then compares the best arb trade with the loan interest of un-invested opportunity and it's respective interest rate.
# If the arb profit is greater than the loan interest, then it logs two trade transactions. (BUY SPOT and SELL FUTURE in the same quantity) 


def get_cryptoSpotPrices(cryptoSpotPrices_file_path = './Resources/cryptoSpotPrices.csv'):

    # This function retrieves SPOT prices of BTC and ETH

    # engine = sql.create_engine('sqlite:///')
    # cryptoSpotPrices_df = pd.read_csv(cryptoSpotPrices_file_path)
    # cryptoSpotPrices_df['spotPrice'] = cryptoSpotPrices_df['spotPrice'].astype(float)
    # return cryptoSpotPrices_df


    btc_spot = get_price("BTC/USD")
    eth_spot = get_price("ETH/USD")

    spot_prices = pd.concat([btc_spot, eth_spot], axis="rows", join="inner")
    spot_prices = spot_prices.rename(columns={"Current Price":"spotPrice"})
    spot_prices = spot_prices.rename_axis('symbol')
    spot_prices["exchange"] = ["FTX", "FTX"]
    spot_prices["underlying"] = ["BTC", "ETH"]
    spot_prices = spot_prices.reset_index()
    spot_prices = spot_prices[["exchange", "underlying", "symbol", "spotPrice"]]
    spot_prices = spot_prices.set_index("underlying")

    spot_prices['underlying'] = spot_prices.index
    spot_prices = spot_prices.reset_index(drop=True)
    spot_prices = spot_prices.drop(['symbol'],axis=1)
    spot_prices = spot_prices[['exchange','underlying','spotPrice']]
    return spot_prices
 
def get_cryptoFuturesPrices(cryptoFuturesPrices_file_path = './Resources/cryptoFuturesPrices.csv'):

    # This function retrieves FUTURE prices of BTC and ETH

    
    # engine = sql.create_engine('sqlite:///')
    # cryptoFuturesPrices_df = pd.read_csv(cryptoFuturesPrices_file_path)
    # cryptoFuturesPrices_df['annualizedReturn'] = cryptoFuturesPrices_df['annualizedReturn'].astype(float)
    # return cryptoFuturesPrices_df

    btc_spot = get_price("BTC/USD")
    eth_spot = get_price("ETH/USD")

    spot_prices = pd.concat([btc_spot, eth_spot], axis="rows", join="inner")
    spot_prices = spot_prices.rename(columns={"Current Price":"spotPrice"})
    spot_prices = spot_prices.rename_axis('symbol')
    spot_prices["exchange"] = ["FTX", "FTX"]
    spot_prices["underlying"] = ["BTC", "ETH"]
    spot_prices = spot_prices.reset_index()
    spot_prices = spot_prices[["exchange", "underlying", "symbol", "spotPrice"]]
    spot_prices = spot_prices.set_index("underlying")

    btc_futures_mar = get_price("BTC-0325")
    btc_futures_jun = get_price("BTC-0624")
    eth_futures_mar = get_price("ETH-0325")
    eth_futures_jun = get_price("ETH-0624")

    # Combines the FUTURES price data into a single DataFrame
    futures_prices = pd.concat([btc_futures_mar, btc_futures_jun,eth_futures_mar, eth_futures_jun], axis="rows", join="inner")

    # Reformats DataFrame for application composability
    futures_prices = futures_prices.rename_axis('symbol')
    futures_prices["exchange"] = ["FTX", "FTX", "FTX", "FTX"]
    futures_prices["underlying"] = ["BTC", "BTC", "ETH", "ETH"]
    futures_prices["expiration"] = ["2022-03-25", "2022-06-24", "2022-03-25", "2022-06-24"]
    futures_prices["expiration"]= pd.to_datetime(futures_prices['expiration'])
    futures_prices = futures_prices.reset_index()
    futures_prices = futures_prices[["exchange", "underlying", "symbol", "expiration", "Current Price"]]
    futures_prices = futures_prices.set_index("underlying")
    futures_prices["spotPrice"] = [spot_prices["spotPrice"]["BTC"], spot_prices["spotPrice"]["BTC"], spot_prices["spotPrice"]["ETH"], spot_prices["spotPrice"]["ETH"]]
    futures_prices["annualizedReturn"] = (futures_prices["Current Price"] - futures_prices["spotPrice"]) / futures_prices["spotPrice"] * 12
    futures_prices = futures_prices.drop(columns=['Current Price', 'spotPrice'])

    futures_prices['underlying'] = futures_prices.index
    futures_prices = futures_prices.reset_index(drop=True)
    futures_prices = futures_prices[['exchange','underlying','symbol','expiration','annualizedReturn']]

    return futures_prices

