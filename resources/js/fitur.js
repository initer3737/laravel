const Preview=()=>{
    const image=document.querySelector('#file');
    const preview=document.querySelector('#img-preview');

    preview.style.display='block';

    const reader=new FileReader();

    reader.readAsDataURL(image.files[0]);
    reader.onload =(eventReader)=>{
        preview.src= eventReader.target.result;
    }
    
}