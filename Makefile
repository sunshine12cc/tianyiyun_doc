SHELL := /bin/bash
TOCFILES:=$(shell find _content -maxdepth 2 -name "index.yml")
help:
	@echo "Please use \`make <target>' where <target> is one of"
	@echo "  build               to build docs"
	@echo "  build-private       to build private docs"
	@echo "  update-layout       to update layout"
	@echo "  server              to preview docs"
	@echo "  update              to update all submodules"
	@echo "  clean               to clean up all generated files"

build: _data/toc.yml
	@if [[ ! -f "$$(which jekyll)" ]]; then \
		echo "ERROR: Command \"jekyll\" not found."; \
	fi
	bundle exec jekyll build --config public_config.yml
	@echo "ok"

build-private: _data/toc.yml
	@if [[ ! -f "$$(which jekyll)" ]]; then \
		echo "ERROR: Command \"jekyll\" not found."; \
	fi
	jekyll build --config public_config.yml,private_config.yml
	@echo "ok"

build-pdf: _data/toc.yml
	@if [[ ! -f "$$(which prince)" ]]; then \
		echo "ERROR: Command \"prince\" not found."; \
	fi
	prince  --javascript --input-list=_site/pdf_index.html -o docs.pdf -s assets/css/pdf.css  --pdf-title="QingCloud Docs" --pdf-author="QingCloud Developers"
	@echo "ok"

_data/toc.yml: $(TOCFILES)
	python scripts/generate_index.py

clean:
	rm -rf _site
	rm -rf .sass-cache
	rm _data/toc.yml


update-layout:
	python scripts/update_layout.py
	@echo "ok"

server: _data/toc.yml
	@if [[ ! -f "$$(which jekyll)" ]]; then \
		echo "ERROR: Command \"jekyll\" not found."; \
	fi
	bundle exec jekyll server --config public_config.yml,private_config.yml --incremental
	@echo "ok"

pdf-server: _data/toc.yml
	@if [[ ! -f "$$(which jekyll)" ]]; then \
		echo "ERROR: Command \"jekyll\" not found."; \
	fi
	bundle exec jekyll server --config public_config.yml,pdf_config.yml --incremental
	@echo "ok"

update:
	@echo "update all submodules"
	git submodule init
	git submodule update --remote
	@echo "ok"

.PHONY: update server update-layout build-private build help clean
