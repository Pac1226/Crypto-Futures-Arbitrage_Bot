import pandas as pd
from path import Path
import sqlalchemy as sql
 
def get_cryptoSpotPrices(cryptoSpotPrices_file_path = './Resources/cryptoSpotPrices.csv'):
    engine = sql.create_engine('sqlite:///')
    cryptoSpotPrices_df = pd.read_csv(cryptoSpotPrices_file_path)
    cryptoSpotPrices_df['spotPrice'] = cryptoSpotPrices_df['spotPrice'].astype(float)
    return cryptoSpotPrices_df
 
def get_cryptoFuturesPrices(cryptoFuturesPrices_file_path = './Resources/cryptoFuturesPrices.csv'):
    engine = sql.create_engine('sqlite:///')
    cryptoFuturesPrices_df = pd.read_csv(cryptoFuturesPrices_file_path)
    cryptoFuturesPrices_df['annualizedReturn'] = cryptoFuturesPrices_df['annualizedReturn'].astype(float)
    return cryptoFuturesPrices_df
