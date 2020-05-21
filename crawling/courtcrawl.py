#!/usr/bin/env python3
# Anchor extraction from HTML document
import requests
from bs4 import BeautifulSoup
from urllib.request import urlopen

response =  urlopen('http://www.landfuture.co.kr/workdir/upcate/kyg/kyg_srch.php?s_year=2015&s_sa_num=8030')
soup = BeautifulSoup(response, 'html.parser')

for anchor in soup.findAll('span', {'class':['address']}):
    print(anchor.get_text())