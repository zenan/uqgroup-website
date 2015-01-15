#!/bin/sh

for i in *.gif; do
    convert $i ${i%%.*}.png
    rm -vf $i
done

for i in *.jpg; do
    convert $i ${i%%.*}.png
    rm -vf $i
done

