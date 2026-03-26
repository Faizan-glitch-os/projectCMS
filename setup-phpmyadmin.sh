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

fi

cd ..
echo "✅ phpMyAdmin setup complete!"
echo "Run: ./start-pma.sh to start phpMyAdmin"
