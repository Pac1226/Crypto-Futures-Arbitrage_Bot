import pandas as pd
from path import Path
from usersLoanBook import get_usersLoanBook
from marketData import (get_cryptoFuturesPrices,get_cryptoSpotPrices)
 
def arbOpportunities():
    usersLoanBook_df = get_usersLoanBook()
    usersAvailableCapacity_df = usersLoanBook_df[usersLoanBook_df['utilizedFlag'] == 'N']
    cryptoSpotPrices_df = get_cryptoSpotPrices()
    cryptoFuturesPrices_df = get_cryptoFuturesPrices()
 
arbOpportunities_df = pd.DataFrame(columns=['exchange','underlying','symbol','expiration','annualizedReturn','userID'])
for index, user in usersAvailableCapacity_df.iterrows():
    arbTemp_df = cryptoFuturesPrices_df[cryptoFuturesPrices_df['annualizedReturn'] > user['intRate']].sort_values('annualizedReturn',ascending=False)
    arbTemp_df['userID'] = user['userID']
    arbOpportunities_df = arbOpportunities_df.append(arbTemp_df.head(1))
 