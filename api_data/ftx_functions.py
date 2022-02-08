"""A Collection of Functions to Collect & Synthesize Crypto Data from the FTX API"""

# Required Libraries for Functions to execute
import pandas as pd
import numpy as np
import requests
from pathlib import Path


"""Get_Price Function pulls the real-time price data on FTX for any trading pair"""

def get_price(ticker):

    # API pull from FTX for current price data
    price_data = pd.DataFrame(requests.get(f'https://ftx.com/api/markets/{ticker}').json())
    
    # Filters and cleans the DataFrame for easier manipulation
    price_data = price_data.drop(['success'], axis=1)
    price_data = price_data.rename(columns={"result":ticker})
    price_data = price_data.T
    price_data = pd.DataFrame(price_data["price"])
    price_data = price_data.rename(columns={"price":"Current Price"})
    
    print(f"Pulling Today's Price for {ticker}...")
    return price_data


""" Get_Historical_Data Function pulls all historical timeseries price data from FTX"""

def get_historical_data(ticker):

    # API pull from FTX for historical timeseries price data
    historical = requests.get(f'https://ftx.com/api/markets/{ticker}/candles?resolution=3600').json()
    historical = pd.DataFrame(historical['result'])
    historical.drop(['startTime'], axis = 1, inplace=True)
    historical['time'] = pd.to_datetime(historical['time'], unit='ms')
    historical.set_index('time', inplace=True)

    # Filters and cleans the DataFrame for easier manipulation
    historical = pd.DataFrame(historical["close"])
    historical = historical.rename(columns={"close" : ticker})
    historical.index.names = ['Date']
    historical.head()

    print(f"{ticker}: Pulling Historical Price Data...")
    return historical

"""Get_Summary_Stats Function calculates the summary statistics for historical arbitrage spreads"""

# Function takes three (3) parameters: 1) historical DataFrame, 2) the spot ticker (str), and 3) name of asset (str)
def get_summary_stats (historical, spot_ticker, asset):
    
    # Calculates the arbitrage spread as a percentage of the spot price
    asset_percent_spread = pd.DataFrame(historical["Arbitrage Spread"] / historical[spot_ticker])

    # Calculates the summary statistics of the percent arbitrage spread
    summary_stats = pd.DataFrame(asset_percent_spread.describe())
    column_names = [asset]
    summary_stats.columns = column_names

    return summary_stats


"""Get_Average_Spread Function calculates the mean of historical arbitrage spreads only"""

# Function takes three (3) parameters: 1) historical DataFrame, 2) the spot ticker (str), and 3) name of asset (str)
def get_average_spread (asset_df, spot_ticker, asset):
    
    # Calculates the arbitrage spread as a percentage of the spot price
    asset_percent_spread = pd.DataFrame(asset_df["Arbitrage Spread"] / asset_df[spot_ticker])
    asset_percent_spread = pd.DataFrame(asset_percent_spread.mean())

     # Cleans the DataFrame for easier manipulation
    column_names = [asset]
    asset_percent_spread.columns = column_names
    asset_percent_spread = asset_percent_spread.T
    new_column_names = ["Historical Daily Arbitrage Spreads"]
    asset_percent_spread.columns = new_column_names

    return asset_percent_spread



""" Compare_Historical_Prices Function combines spot and futures DataFrames into a single DataFrame"""

# FUNCTION STILL IN DEVELOPMENT / NOT WORKING
def compare_historical_prices(futures_df, spot_df, futures_ticker, spot_ticker):
    both_prices = pd.concat([futures_df, spot_df], axis="columns", join="inner")
    both_prices["Arbitrage Spread"] = both_prices[futures_ticker] - both_prices[spot_ticker]
    both_prices["30 Day SMA of Spread"] = both_prices["Arbitrage Spread"].rolling(window=30).mean().dropna()
    return both_prices
