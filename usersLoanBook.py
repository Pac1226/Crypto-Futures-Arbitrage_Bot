import pandas as pd
from path import Path
import sqlalchemy as sql
import mysql.connector as db_conn
 
# Read the existing users and loans funded by investors
# Get the data from the sql server table
# This function was originally written to read the data from a csv file. However, it has been enhanced to retrieving data from database.
# The old code is still maintained and commented for future use
# 

def get_usersLoanBook(usersLoanBook_file_path = './Resources/usersLoanBook.csv'):
    cnx = db_conn.connect(host='198.71.55.59', database='columbia-p1', user='team1', password='teamOneRocks-1', port=3306)
    # engine = sql.create_engine('sqlite:///')
    # userLoanBook_df = pd.read_csv(usersLoanBook_file_path)
    userLoanBook_df = pd.read_sql_query('Select * from usersLoanBook_view', cnx)
    userLoanBook_df['loanAmt'] = userLoanBook_df['loanAmt'].astype(float)
    userLoanBook_df['intRate'] = userLoanBook_df['intRate'].astype(float)
    return userLoanBook_df
 
# Write the new loan to usersLoanBook.csv
def send_usersLoanBook(userLoanBook_df):
    usersLoanBook_file_path = './Resources/usersLoanBook.csv'
    engine = sql.create_engine('sqlite:///')
    userLoanBook_df.to_csv(usersLoanBook_file_path,index = False)
    return userLoanBook_df
