FROM ubuntu:latest
LABEL authors="maxime"

ENTRYPOINT ["top", "-b"]
