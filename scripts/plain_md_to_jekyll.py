import os
import sys

def get_file_list(file_path):
    file_list = []
    for root, _, files in os.walk(file_path):
        for f in files:
            if f.endswith(".md"):
                file_list.append(os.path.join(root, f))
    return file_list

def convert(file_path):
    # print("sed -i '1i\---\\n---\\n' %s" % file_path)
    os.system("sed -i '1i\---\\n---\\n' %s" % file_path)

def main(argv=None):
    if argv is None:
        argv = sys.argv[1:]
    for i in get_file_list(argv[0]):
        convert(i)
        print("%s converted." % i)
    # print(get_file_list(argv[0]))

if __name__ == "__main__":
    sys.exit(main())
