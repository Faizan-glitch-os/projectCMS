#!/bin/bash
# Setup phpMyAdmin for this project
# Run: ./setup-phpmyadmin.sh

echo "Setting up phpMyAdmin for projectCMS..."

# Create directory
mkdir -p .phpmyadmin_server
cd .phpmyadmin_server

# Download if not exists
if [ ! -d "public" ]; then
    echo "Downloading phpMyAdmin..."
    wget -q https://www.phpmyadmin.net/downloads/phpMyAdmin-latest-all-languages.zip
    unzip -q phpMyAdmin-latest-all-languages.zip
    mv phpMyAdmin-*-all-languages public
    rm phpMyAdmin-latest-all-languages.zip
    
    # Create directories
    cd public
    mkdir -p tmp upload save
    chmod 755 tmp upload save
    
    # Create config from example if exists
    if [ -f "../../config.inc.php.example" ]; then
        cp "../../config.inc.php.example" config.inc.php
        echo "✅ Config created from example"
    else
        echo "⚠️ No config.inc.php.example found, please create one"
    fi
    cd ..
fi

cd ..
echo "✅ phpMyAdmin setup complete!"
echo "Run: ./start-pma.sh to start phpMyAdmin"
