SFTP live verbinding
1. Installer de vscode plugin: SFTP - Natizyskunk 
2. Open de settings met CMD+Shift+P en typ in "sftp: config" er word een .vscode  mapje in dit theme gemaakt met daarin een sftp.json
3. Verandert de locatie van de remotepath in connection/sftp.json
4. Kopier de connection/sftp.json naar .vscode/sftpjson (overschrijf het)
5. Zet SFTP aan door op op SFTP aan de onderkant van Vscode te klikken.

Proxy (live reload)
1. Zorg dat browser sync globaal met de terminal command:     npm install -g browser-sync
2. In bs-config verander de url naar de url van het ontikkel domein
3. Open de live connectie en laat de temrinal open staan command in de terminal:
browser-sync start --config connection/bs-config.js

Open de website via https://localhost:3000 

