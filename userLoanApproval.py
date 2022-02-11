import pandas as pd
from path import Path
from usersLoanBook import send_usersLoanBook
 
def userLoanApproval(userID,loanRequest,investor_df,user_df,usersLoanBook_df):
    # Get the user details based on the user ID
    user_info = user_df.loc[userID]
   
    # Filter investors based on credit quality
    investor_df['investorID'] = investor_df.index
    investor_df = investor_df[investor_df['minCreditScore'] <= user_info['creditScore']]
 
    # Calculate investor capacity
    investor_outstanding_loans_df = usersLoanBook_df[usersLoanBook_df['utilizedFlag'] == 'Y'][['investorID','loanAmt']].groupby('investorID').sum()
    investor_df = pd.concat([investor_df,investor_outstanding_loans_df],axis='columns',sort=False).fillna(0)
    investor_df['loanCapacity'] = investor_df['totalInvestmentAmount'] - investor_df['loanAmt']
   
    # Filter investors based on capacity limitation
    investor_df = investor_df[investor_df['loanCapacity'] >= loanRequest].sort_values('intRate')
 
    print("After adding investor id")
    print(investor_df)
 
 
    if len(investor_df) == 0:
        print(f"Thanks for your application. Unfortunately there are no investors ready to fund your investment. Please try again later.")
    else:
        investor_df = investor_df.iloc[0]
        usersLoanBook_df.loc[len(usersLoanBook_df.index)] = [userID,investor_df['investorID'], loanRequest,investor_df['intRate'],"N"]
        send_usersLoanBook(usersLoanBook_df)
        companyName = investor_df['companyName']
        intRate = investor_df['intRate']
        print(f"Congratulations, we have matched you with an investor. {companyName} will loan you $ {loanRequest} at {intRate}" )  
    return investor_df