import requests
from bs4 import BeautifulSoup
from flask import Flask,render_template

app=Flask(__name__)
@app.route("/member")
def index():
    return render_template('textPython.html',myname="test")

if __name__=="__main__":
    app.run(debug=True)

url="https://bscscan.com/token/0x844fa82f1e54824655470970f7004dd90546bb28"
web_data=requests.get(url)

soup=BeautifulSoup(web_data.text,'html.parser')
find_word=soup.find_all("span","class:col-xs-12")
mytext=soup.find(class_="hash-tag text-truncate")
mytext2=soup.find(class_="mr-3")
print(mytext.get_text())
print(mytext2.get_text())