#---------------------------2024-02-10 for Collin College ITSE2374------------------------------------
import os #to change/find current directory
import psycopg2
import sys


host_name='dpg-cn3qb5qcn0vc738pmp7g-a.oregon-postgres.render.com'
db_name='inew2374250spring24'
user_name='inew2374250spring24_user'
password='4i2U9tzMVYLGbj7ePpxmiyHr4oIflMf1'
conn = psycopg2.connect(host= host_name, database = db_name, user = user_name,  password = password, port = 5432)
cur = conn.cursor()
#----------------------------To create a new table. Execute once only-------------------------------------------------
# Table_name="USER_LIST"
# cur.execute('CREATE TABLE "ITSE-2374-APP-4"."'+str(Table_name)+'"('+"""
#             user_id SERIAL PRIMARY KEY,
#             first_name VARCHAR (20) NOT NULL,
#             last_name VARCHAR (20) NOT NULL,
#             email VARCHAR (100) UNIQUE NOT NULL,
#             password VARCHAR (20) NOT NULL,
#             validation_status VARCHAR (3) NOT NULL,
#             last_update VARCHAR (20) NOT NULL,
#             validation_code VARCHAR (10) NOT NULL);
#             """)
Table_name="INDIVIDUAL_MESSAGE"
cur.execute('CREATE TABLE "ITSE-2374-APP-4"."'+str(Table_name)+'"('+"""
            message_id SERIAL PRIMARY KEY,
            author_first_name VARCHAR (20)  NULL,
            author_last_name VARCHAR (20)  NULL,
            author_email VARCHAR (100) NOT NULL,
            receiver_first_name VARCHAR (20)  NULL,
            receiver_last_name VARCHAR (20)  NULL,
            receiver_email VARCHAR (100) NOT NULL,
            post_message VARCHAR (500) NOT NULL,
            last_update VARCHAR (20) NOT NULL);
            """)
#----------------------------To delete rows in a table. Execute as need-------------------------------------------------

# cur.execute("""DELETE FROM """+str(Table_name)+""" WHERE 1=1;
#             """)

# cur.execute("""DROP TABLE """+str(Table_name)) 

#-----------------------------------------------------------------------------------------------------------------------
conn.commit()
cur.close()
conn.close()