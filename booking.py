import sqlite3

# Connect to the SQLite database
conn = sqlite3.connect('mydatabase.db')
cursor = conn.cursor()

# Sample data
data_to_insert = [(1, 'John'), (2, 'Alice'), (3, 'Bob')]

# SQL statement with placeholders
insert_sql = "INSERT INTO mytable (id, name) VALUES (?, ?)"

# Loop through the data and insert it into the database
for entry in data_to_insert:
    cursor.execute(insert_sql, entry)

# Commit the changes and close the connection
conn.commit()
conn.close()
