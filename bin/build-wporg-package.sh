#!/bin/bash

# cleanup
rm -rf dist

# copy m
mkdir dist
cp deib-language-checker.php dist
cp -r src dist
cp -r languages dist

# copy assets
cp -r wp-assets/* dist

echo "Plugin has been build at ./dist"
