#!C:\Users\shaha\AppData\Local\Programs\Python\Python37\python.exe
print("Content-type: text/html\n")

import pandas as pd
from datetime import date
from pathlib import Path
from usersLoanBook import get_usersLoanBook
from marketData import (get_cryptoFuturesPrices,get_cryptoSpotPrices)
import pymysql
 
# This function scans teh usersLoanBook table and identifies arb opportunities for un-invested money
# This function can be called on regular frequency or on a scheduled intervals

def arbOpportunities():
    usersLoanBook_df = get_usersLoanBook()

    usersUnAvailableCapacity_df = usersLoanBook_df[usersLoanBook_df['utilizedFlag'] == 'Y']
    
    # identify uninvested money
    usersAvailableCapacity_df = usersLoanBook_df[usersLoanBook_df['utilizedFlag'] == 'N']
    cryptoSpotPrices_df = get_cryptoSpotPrices()
    cryptoFuturesPrices_df = get_cryptoFuturesPrices()

    connection = pymysql.connect(host='198.71.55.59',user='team1',password='teamOneRocks-1',db='columbia-p1', port=3306)
    cursor = connection.cursor() 

    arbOpportunities_df = pd.DataFrame(columns=['exchange','underlying','symbol','expiration','annualizedReturn','userID'])
    transactionLog_df = pd.DataFrame(['txDate','userID','exchange','symbol','buySellFlag','lots'])
    today = date.today()

    for index, user in usersAvailableCapacity_df.iterrows():

        # Identify if there are any arb opportunities, i.e opportunities where the annuanlized return is greater than loan's interest rate
        arbTemp_df = cryptoFuturesPrices_df[cryptoFuturesPrices_df['annualizedReturn'] > user['intRate']].sort_values('annualizedReturn',ascending=False)

        # If there are multiple arb opportunities, then invest the money in the best investment, i.e. where the annualized return is the highest
        # Also update the utilized flag to Y for that investment
        # If no arb opporunities exist, just return a message to the user.
        if len(arbTemp_df) > 0:
            arbTemp_df['userID'] = user['userID']
            print(arbTemp_df)
            user_arbOppurtunity = arbTemp_df.iloc[0]

            # Retrieve the spot price and calculate the lots for trading

            cryptoSpotPrice_df = cryptoSpotPrices_df[cryptoSpotPrices_df['underlying'] == user_arbOppurtunity['underlying']]
            cryptoSpotPrice = cryptoSpotPrice_df.loc[0,'spotPrice']

            lots= (user['loanAmt'] / cryptoSpotPrice)

            # Create one buy transaction of Spot trade and one sell transaction of the future in the same underlying

            # transactionLog_df.loc[len(transactionLog_df.index)] = [today,user['userID'],user_arbOppurtunity['exchange'],user_arbOppurtunity['underlying'],"BUY",lots]
            # transactionLog_df.loc[len(transactionLog_df.index)] = [today,user[' userID'],user_arbOppurtunity['exchange'],user_arbOppurtunity['symbol'],"SELL",lots]

            userID = user['userID']
            exchange = user_arbOppurtunity['exchange']
            symbol = user_arbOppurtunity['underlying']
            buySellFlag = 'BUY'
            price = cryptoSpotPrice

            insert_sql = f"""
            INSERT INTO transactionLog (txDate,userID,exchange,symbol,buySellFlag,lots,price)
            VALUES ('{today}','{userID}','{exchange}','{symbol}','{buySellFlag}',{lots},{price})
            """
            cursor.execute(insert_sql)

            symbol = user_arbOppurtunity['symbol']
            buySellFlag = 'SELL'
            price = price * (1 + user_arbOppurtunity['annualizedReturn'])

            insert_sql = f"""
            INSERT INTO transactionLog (txDate,userID,exchange,symbol,buySellFlag,lots,price)
            VALUES ('{today}','{userID}','{exchange}','{symbol}','{buySellFlag}',{lots},{price})
            """
            cursor.execute(insert_sql)

            update_sql = f"""
            UPDATE usersLoanBook
            SET utilizedFlag = 'Y'
            WHERE approvalID = '{user['approvalID']}'
            """

            cursor.execute(update_sql)

            connection.commit()

            # arbOpportunities_df = arbOpportunities_df.append(arbTemp_df.head(1))
        else:
            print(f"There are no arbitrage opportunities for you at this time. But our machine algorithm will keep searching and find you the best opportunity.")
