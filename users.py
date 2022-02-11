import pandas as pd
from path import Path
import sqlalchemy as sql
 
def get_users(users_file_path = './Resources/users.csv'):
    engine = sql.create_engine('sqlite:///')
    user_df = pd.read_csv(users_file_path,index_col='userID')
    user_df['creditScore'] = user_df['creditScore'].astype(int)
    return user_df