import pandas as pd
from path import Path
import sqlalchemy as sql
import mysql.connector as db_conn


#
# Get the investors data from the sql server table
# This function was originally written to read the data from a csv file. However, it has been enhanced to retrieving data from database.
# The old code is still maintained and commented for future use
# 

def get_investors(investors_file_path = '.Resources/investors.csv'):
    cnx = db_conn.connect(host='198.71.55.59', database='columbia-p1', user='team1', password='teamOneRocks-1', port=3306)
    # engine = sql.create_engine('sqlite:///')
    # investor_df = pd.read_csv(investors_file_path,index_col='investorID')

    investor_df = pd.read_sql_query('Select * from investors_view', cnx, index_col='investorID')
    investor_df['totalInvestmentAmount'] = investor_df['totalInvestmentAmount'].astype(float)
    investor_df['loanPerUser'] = investor_df['loanPerUser'].astype(float)
    investor_df['minCreditScore'] = investor_df['minCreditScore'].astype(int)
    investor_df['intRate'] = investor_df['intRate'].astype(float)
    return investor_df