from elasticsearch import Elasticsearch
import os
import re

index_name = "docs"
doc_type = "post"

def connect_elastic(host="192.168.65.28", port=9200):
    return Elasticsearch([{'host': host, 'port': 9200}])

def refresh_index(es):
    if es.indices.exists(index=index_name):
        es.indices.delete(index=index_name)
    es.indices.create(index=index_name)

def index_posts(es, posts):
    for post in posts:
        doc = {
            "title": post.title,
            "url": post.url,
            "body": post.body
        }

        es.index(index=index_name, doc_type=doc_type, id=post.id, body=doc)
        print("Created doc for " + post.url)
