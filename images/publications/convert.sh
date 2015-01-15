#!/bin/sh

for i in *.jpg; do
    convert $i ${i%%.*}.png
done

rm -vf *.jpg
