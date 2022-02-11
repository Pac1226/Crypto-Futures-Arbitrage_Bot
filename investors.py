import pandas as pd
from path import Path
import sqlalchemy as sql

def get_investors(investors_file_path = '.Resources/investors.csv'):
    engine = sql.create_engine('sqlite:///')
    investor_df = pd.read_csv(investors_file_path,index_col='investorID')
    investor_df['totalInvestmentAmount'] = investor_df['totalInvestmentAmount'].astype(float)
    investor_df['loanPerUser'] = investor_df['loanPerUser'].astype(float)
    investor_df['minCreditScore'] = investor_df['minCreditScore'].astype(int)
    investor_df['intRate'] = investor_df['intRate'].astype(float)
    return investor_df