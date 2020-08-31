import os
import sys
import requests
from bs4 import BeautifulSoup

tmpl_url = "https://www.qingcloud.com/helpndocs"
file_path = "_includes"


def get_page_content(url):
    resp = requests.get(url)
    return resp.content


def parse_page(content):
    soup = BeautifulSoup(content, "lxml")
    parts = {
        "head": "head.html",
        "footer": "footer_data.html",
        "header": "navmenu.html"
    }

    def parse_data(tag, file_name):
        with open(os.path.join(file_path, file_name), "w") as f:
            f.write(str(soup.find_all(tag)[0]))

    for k, v in parts.items():
        parse_data(k, v)


def main():
    content = get_page_content(tmpl_url)
    parse_page(content)

if __name__ == "__main__":
    sys.exit(main())
