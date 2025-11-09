#!/usr/bin/env bash
set -e

echo "==== Empaquetando versiones de la webapp ===="

BASE_DIR=$(pwd)
OUT_DIR="$BASE_DIR/target/webartifacts"
mkdir -p "$OUT_DIR"

echo "Empaquetando vulnerable..."
zip -r "$OUT_DIR/vulnerable.zip" "src/webapp/vulnerable" -x "*.git*"

echo "Empaquetando secure..."
zip -r "$OUT_DIR/secure.zip" "src/webapp/secure" -x "*.git*"

echo "Empaquetado completado. Archivos en $OUT_DIR"
