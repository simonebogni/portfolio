//project headers
import DopingHeader from './header/doping.png';
import EducationHeader from './header/education.png';
import GDPHeader from './header/gdp.png';
import KickstarterHeader from './header/kiskstarter.png';
import TemperatureHeader from './header/temperature.png';

//import gallery

//ProjectImages objects
class ProjectImages {
    constructor(headerImage, galleryImagesArray){
        this.header = headerImage;
        this.galleryArray = galleryImagesArray;
        this.getHeader = this.getHeader.bind(this);
        this.getGalleryArray = this.getGalleryArray.bind(this);
    }

    getHeader(){
        return this.header;
    }

    getGalleryArray(){
        return this.galleryArray;
    }
}

let Doping = new ProjectImages(DopingHeader, []);
let Education = new ProjectImages(EducationHeader, []);
let Gdp = new ProjectImages(GDPHeader, []);
let Kickstarter = new ProjectImages(KickstarterHeader, []);
let Temperature = new ProjectImages(TemperatureHeader, []);

export {Doping, Education, Gdp, Kickstarter, Temperature}