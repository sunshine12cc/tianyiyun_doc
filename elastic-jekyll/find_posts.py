import glob
from bs4 import BeautifulSoup
from post import Post
import os
import re

def find_post_paths(base_dir, target_folder):
    file_list = []
    for targetFolder in target_folder:
        for root, dirs, files in os.walk(base_dir + targetFolder):
            for file in files:
                if file.endswith(".html"):
                    if 'pdf' not in file:
                        print(os.path.join(root, file))
                        file_list.append(os.path.join(root, file))
    return file_list

def parse_post(path):
    print(path)
    with open(path, encoding="utf8") as f:
        contents = f.read()
        soup = BeautifulSoup(contents, 'html.parser')
        try:
            docs = soup.find("div", {"class" : "docs-content"})
            try:
                title = docs.find("h1").text
                docs_string = ''.join(str(child) for child in docs.children)
                body = re.sub("<.*?>", " ", docs_string).replace("\n", " ")
                # remove special characters
                return (title, body)
            except:
                docs_string = ''.join(str(child) for child in docs.children)
                body = re.sub("<.*?>", " ", docs_string).replace("\n", " ")
                # remove special characters
                return ('', body)
        except:
            #  print('not find docs-content')
             return ('', '')

    # raise "Could not read file: " + path


def create_posts(base_dir):
    paths = find_post_paths(base_dir, ['/product', '/qingstor', '/appcenter/docs', '/appcenter1'])
    for path in paths:
        id = path.replace(base_dir, "").replace("/", "-")
        url = path.replace(base_dir, "")
        url = url.replace(".html", "")
        (title, body) = parse_post(path)
        yield Post(id, title, url, body)
