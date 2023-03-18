
export default class Localidade{

    constructor(municipio_id){
        this.municipio_id = municipio_id
    }

    getmunicipioId(){
        return this.municipio_id
    }

    static criarmunicipio(municipio_id){
        const municipio = new Localidade(municipio_id)
        return municipio.getmunicipioId();
    }
}
