import os
import sys
import yaml


def main():
    with open("_data/toc.yml", "w") as toc:
        with open("index.yml") as f:
            index = yaml.load(f)
            for i in index:
                sub_index_path = "_content/%s/index.yml" % i
                if os.path.exists(sub_index_path):
                    with open(sub_index_path) as sub_index:
                        toc.write(sub_index.read())
                else:
                    print(sub_index_path, "doesn't exist,please provide index.yaml")

if __name__ == "__main__":
    sys.exit(main())
