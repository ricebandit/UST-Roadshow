const themeName = 'roads';
const rootName = 'build';
const fs = require('fs');
const path = require('path');

const copyRecursive = (src, dest) => {
    const exists = fs.existsSync(src);
    const stats = exists && fs.statSync(src);
    const isDirectory = stats && stats.isDirectory();


    if(isDirectory){
        if(!fs.existsSync(dest)){
            if( dest.indexOf('dev-scripts') == -1 ){
                fs.mkdirSync(dest);
            }else{
                return;
            }
            
        }

        fs.readdirSync(src).forEach( childItemName => {
            copyRecursive(path.join(src, childItemName), path.join(dest, childItemName));
            
        })
    }else{
        fs.copyFileSync(src, dest);
    }
}

copyRecursive('./src', '../' + rootName + '/wp-content/themes/' + themeName);





