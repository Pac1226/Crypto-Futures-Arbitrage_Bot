# Columbia_Fintech_Project1

# Project Title Arb-Bot

Most of the financial products are traded in cash as well as futures market. The futures contract is a legal obligation to perform at a future date. 
Most of the financial products do not have storage cost and hence the cost of carry is primarily driven by funding cost. 
This causes most of the financial products to display Contango behavior. Assets showing Contango behavior have upward future slope. 
This creates an arbitrage opportunity by buying a similar asset in spot market and selling in futures market. This is commonly known as basis trade.

Our project aims to capture any arbitrage between spot and futures market. This provides guaranteed income for our users. 
In order to achieve this, the app will do the following

Web interface for the user to 
Enter personal details and credit information
Require the amount of funds to be loaned (limited by credit ratings and
investor appetite)
Interface with FTX exchange
API connections for data extraction from FTX for spot and futures prices
Flat file connectivity for interest rate cards
Reporting and interactive interface
Market data dashboard

---

## Technologies

This project is written in python. The required libraries are as follows
pathlib ver 2.3.6, pandas, hvplots.pandas, sys, pymysql


---

## Usage

This project sources historical data and current prices (SPOT and FUTURES). It identifies arbitrage opportunities and lock in profits for the users.
The application alo matches users and investors. It identifies the investor with the least interest rate for the user.

## Analysis Report
 
The application was demonstrated successfully with following features

1) USer portal, where the user can create a user profile, enter their credentials
2) User can request for loan amount
3) The application matches the user with the investor offering the least interest rate
4) The application retries live data from FTX exchange using API calls
5) The application identifies any arbitrage opportunities if available and locks in the profit by booking trades in the transaction log
6) Market Analytics shown on the front end 