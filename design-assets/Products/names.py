import os, re

subfolders = [ f.path for f in os.scandir('C:/Users/senna/OneDrive - Blackpool and The Fylde College/25-28/Year 2/Responsive Dynamic Web Development/Assessment 1/Assets/Products') if f.is_dir() ]

for i in subfolders:
    x = re.findall('.*?\\\\(.*)', i)
    print(x[0])

input()