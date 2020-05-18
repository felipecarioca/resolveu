var prestadoresApp = new Vue({
  el: "#cardprofile",
  
  data: {
    pesquisa: "",
    tituloPagina: "Meus Livros",
    paginaAtual: "espera",
    capa: "",
    novoLivro:{},
    prestadores:[],
    ShowForm: false,
    iptTitulo: "",
    responseGoogleBooks: []
  },
  
  mounted() {

    const self = this;

    axios.get('http://localhost/resolveu/api/prestadores')
      .then(function (response) {

        self.prestadores = response.data;
        // handle success
        console.log(response);
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      })
      .finally(function () {
        // always executed
        console.log("Executado com sucesso!");
      });
  },

  computed: {
    LivrosFiltrados() {
      return this.prestadores.filter((prestador) => {
        return this.pesquisa.toLowerCase().split(' ').every(v => prestador.nome.toLowerCase().includes(v));
      });
    }
  },

  methods:{

    subString(str) {

      if(str.length > 55)
        return str.substring(0,55) + "...";

      return str;
    },

    upper(str) {
      return str.toUpperCase();
    },

    getGoogleBooks:function(){
      
      const self = this;

      axios.get('https://www.googleapis.com/books/v1/volumes?q=' + self.iptTitulo)
        .then(function (response) {

          self.responseGoogleBooks = response.data.items;
          // handle success
          //console.log(response.data.items);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
        .finally(function () {
          // always executed
          console.log("Executado com sucesso!");
        });
        
    },

    loadLidos:function(){
      
      this.tituloPagina = "Lidos";
      this.paginaAtual = "lidos";

      const self = this;

      axios.get('http://localhost/mybooks/api/livros/lidos')
        .then(function (response) {

          self.livros = response.data;
          // handle success
          console.log(response);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
        .finally(function () {
          // always executed
          console.log("Executado com sucesso!");
        });
        
    },

    loadEspera:function(){
      
      this.tituloPagina = "Meus Livros";
      this.paginaAtual = "espera";

      const self = this;

      axios.get('http://localhost/mybooks/api/livros')
        .then(function (response) {

          self.livros = response.data;
          // handle success
          console.log(response);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
        .finally(function () {
          // always executed
          console.log("Executado com sucesso!");
        });
        
    },

    ler:function(livro){
      
      const self = this;

      axios.put('http://localhost/mybooks/api/livros/'+livro.id,
        {
          "titulo": livro.titulo,
          "paginas": livro.paginas,
          "capa": livro.capa,
          "lido": "1"
        }
      ).then(function (response) {

          self.livros = response.data;
          // handle success
          console.log(response);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
        .finally(function () {
          // always executed
          self.loadEspera();
          console.log("Executado com sucesso!");
        });
        
    },

    remover:function(livro){
      
      const self = this;

      axios.delete('http://localhost/mybooks/api/livros/'+livro.id
      ).then(function (response) {

          self.livros = response.data;
          // handle success
          console.log(response);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
        .finally(function () {
          // always executed
          self.loadLidos();
          console.log("Livro excluído com sucesso!");
        });
        
    },

    salvarLivro:function(index, book) {
      
      this.responseGoogleBooks.splice(index, 1);

      this.novoLivro = {
        "titulo": book.volumeInfo.title,
        "paginas": book.volumeInfo.pageCount,
        "capa": book.volumeInfo.imageLinks.thumbnail
      };

      const self = this;

      axios.post('http://localhost/mybooks/api/livros', this.novoLivro)
        .then(function (response) {

          self.livros = response.data;
          // handle success
          console.log(response);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
        .finally(function () {
          // always executed
          
          self.novoLivro = {};
          self.loadEspera();

          console.log("Livro salvo com sucesso!");
        });
    }

  }
});