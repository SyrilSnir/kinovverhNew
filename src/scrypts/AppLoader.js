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
        let numberInputs = document.querySelectorAll('.pay-summ');
        numberInputs.forEach(item => {
          item.addEventListener('input', () => {
            item.value = item.value.replace(/\D/,'');            
          });
        });
        console.log('Запуск приложения');
    }

}
export default AppLoader;