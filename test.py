#! C:\Users\shaha\AppData\Local\Programs\Python\Python37\python.exe
print("Content-type: text/html")
print("")
print("<html><head>")
print("")
print("</head><body>")
print("Hello.")
print("</body></html>")


import pandas as pd
from pathlib import Path
from users import get_users
from investors import get_investors
from usersLoanBook import (get_usersLoanBook,send_usersLoanBook)
import mysql.connector as db_conn
import pymysql