import pandas as pd
from path import Path
from users import get_users
from investors import get_investors
from usersLoanBook import (get_usersLoanBook,send_usersLoanBook)
import mysql.connector as db_conn
import pymysql
 
# UserLoanApproval funtion requires two parameters.
# User ID and loan request. Based on these two parameters, the function identifies a list of investors who are ready to fund the loan request, based on user's credentials.
# If there are more than one investors, then the investor with the least interest rate is selected.
# The list of investors is short listed based on following logic
#       1) Minimum credit score threshold
#       2) Investor's unused loan capacity
#       3) Max loan per user offered by the investor
# Once a investor is identified, this is recorded in the userLoanApproval table in SQL Server


def userLoanApproval(userID,loanRequest):
    connection = pymysql.connect(host='198.71.55.59',user='team1',password='teamOneRocks-1',db='columbia-p1', port=3306)
    cursor = connection.cursor()

    user_df = get_users()
    investor_df = get_investors()
    usersLoanBook_df = get_usersLoanBook()

    # Get the user details based on the user ID
    user_info = user_df.loc[userID]

    # Filter investors based on credit quality
    investor_df['investorID'] = investor_df.index
    investor_df = investor_df[investor_df['minCreditScore'] <= user_info['creditScore']]

    # Calculate investor capacity
    investor_outstanding_loans_df = usersLoanBook_df[usersLoanBook_df['utilizedFlag'] == 'Y'][['investorID','loanAmt']].groupby('investorID').sum()
    investor_df = pd.concat([investor_df,investor_outstanding_loans_df],axis='columns').fillna(0)
    investor_df['loanCapacity'] = investor_df['totalInvestmentAmount'] - investor_df['loanAmt']

    # Filter investors based on unutilized investor capacity and loan per user 
    investor_df = investor_df[(investor_df['loanCapacity'] >= loanRequest) & (investor_df['loanPerUser'] > loanRequest)].sort_values('intRate')

    if len(investor_df) == 0:
        print(f"Thanks for your application. Unfortunately there are no investors ready to fund your investment. Please try again later.")
    else:
        investor_df = investor_df.iloc[0]
        # usersLoanBook_df.loc[len(usersLoanBook_df.index)] = [userID,investor_df['investorID'], loanRequest,investor_df['intRate'],"N"]
        # send_usersLoanBook(usersLoanBook_df)
        investorID = investor_df['investorID']
        approvalID = userID + '-' + investorID
        intRate = investor_df['intRate']
        utilizedFlag = 'N'
        insert_sql = f"""
        INSERT INTO usersLoanBook_view (approvalID,userID,investorID,loanAmt,intRate,utilizedFlag)
        VALUES ('{approvalID}','{userID}','{investorID}','{loanRequest}','{intRate}','{utilizedFlag}')
        """

        cursor.execute(insert_sql)
        connection.commit()

        companyName = investor_df['companyName']
        print(f"Congratulations, we have matched you with an investor. {companyName} will loan you $ {loanRequest} at {intRate * 100} %" )  
    return investor_df