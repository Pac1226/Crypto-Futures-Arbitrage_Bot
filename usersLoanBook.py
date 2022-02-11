import pandas as pd
from path import Path
import sqlalchemy as sql
 
# Read the existing users and loans funded by investors
def get_usersLoanBook(usersLoanBook_file_path = './Resources/usersLoanBook.csv'):
    engine = sql.create_engine('sqlite:///')
    userLoanBook_df = pd.read_csv(usersLoanBook_file_path)
    userLoanBook_df['loanAmt'] = userLoanBook_df['loanAmt'].astype(float)
    userLoanBook_df['intRate'] = userLoanBook_df['intRate'].astype(float)
    return userLoanBook_df
 
# Write the new loan to usersLoanBook.csv
def send_usersLoanBook(userLoanBook_df):
    usersLoanBook_file_path = './Resources/usersLoanBook.csv'
    engine = sql.create_engine('sqlite:///')
    userLoanBook_df.to_csv(usersLoanBook_file_path,index = False)
    return userLoanBook_df
