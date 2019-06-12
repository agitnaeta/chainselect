$(document).ready(function(){
    
    /**
     * Select Provinsi
     */
    let url = 'http://chain.test/proses.php?provinsi=0';
    $.get(url,(data)=>{
        console.log(data)
        createOption(data,'select_provinsi')
    })

    function createOption(data,dom){
       let provinsi =  $('#'+dom)

       data.map((v,i)=>{
           let option = document.createElement('option')
           option.value   = v.id
           option.innerHTML = v.name

           provinsi.append(option)
       })
    }

    $('#select_provinsi').change((e)=>{
        let pi = e.target.value
        let urlKabupaten = 'http://chain.test/proses.php?provinsi='+pi+'&kabupaten=0';
        $.get(urlKabupaten,(data)=>{
            createOption(data,'select_kabupaten')
        })
    })


    /**
     * Select Kabupaten
     */
})