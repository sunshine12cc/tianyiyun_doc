from elasticsearch import Elasticsearch

es =  Elasticsearch([{'host': 'localhost', 'port': 9200}])

user_query = "对象存储"

query = {
    "from" : 0, "size" : 2,
    "query": {
        "multi_match": {
            "query": user_query,
            "type": "phrase",
            "fields": [
                "title",
                "body"
            ]
        }
    },
    "highlight" : {
        "number_of_fragments" : 1,
        "fragment_size" : 150,
        "fields" : {
            "title": {},
            "body" : {}
        }
    }
}

res = es.search(index="docs", body=query)
print("Found %d Hits:" % res['hits']['total'])

for hit in res['hits']['hits']:
    print(hit["highlight"])

# POST /blog/post/_search
# {
#     "query": {
#       "multi_match": {
#         "query": "python",
#         "type": "best_fields",
#         "fuzziness": "AUTO",
#         "tie_breaker": 0.3,
#         "fields": ["title^3", "body"]
#       }
#     },
#     "highlight": {
#         "fields" : {
#             "body" : {}
#         }
#     },
#     "_source": ["title", "url"]
# }
