//import globalLoader from './kv';

import bxSliderLoader from './bxSliderLoader';
import ShowCaption from './Components/ShowCaption';

class AppLoader {
    constructor() {
        this.bxSliderLoader = new bxSliderLoader();
        this.showCaption = new ShowCaption();
      //  this.defaultPlayer = new VideoPlayer('#my-video')
    }
    run() {
   //     this.globalLoader.init();
        this.bxSliderLoader.init();
        console.log('Запуск приложения');
    }

}
export default AppLoader;