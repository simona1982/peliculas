let baseUrl = 'http://192.168.10.10:8000/';

if (process.env.NODE_ENV === 'production') {
   baseUrl = 'http://192.81.214.173/';
}else {
   baseUrl = 'http://restaurante.test/';
}

export const apiDomain = baseUrl
export const uploadImageUserUrl = apiDomain + 'image-user/upload_image.jpg'
export const uploadImagePointUrl = apiDomain + 'image-point/upload_image.jpg'

export const uploadImageUserPathUrl = apiDomain + 'image-user/'
export const uploadImagePointPathUrl = apiDomain + 'image-point/'
export const uploadImageClientPathUrl = apiDomain + 'image-client/'