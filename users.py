import pandas as pd
from path import Path
import sqlalchemy as sql
import mysql.connector as db_conn

 
def get_users(users_file_path = './Resources/users.csv'):

    cnx = db_conn.connect(host='198.71.55.59', database='columbia-p1', user='team1', password='teamOneRocks-1', port=3306)
    # engine = sql.create_engine('sqlite:///')
    # user_df = pd.read_csv(users_file_path,index_col='userID')
    user_df = pd.read_sql_query('Select * from users_view', cnx, index_col='userID')
    user_df['creditScore'] = user_df['creditScore'].astype(int)
    return user_df