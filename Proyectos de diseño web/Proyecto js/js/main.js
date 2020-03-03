$(document).ready(()=>{
    'use strict'

    //Slider
    if(window.location.href.indexOf('index') > -1){
        $(".slider").bxSlider({
            mode: 'fade',
            captions: true,
            slideWidth: 1200,
            responsive: true,
            speed: 1000
        });
    }

    //Post 
    if(window.location.href.indexOf('index') > -1){
        var posts = [
            {
                title: "Prueba de titulo 1",
                date: 'Publicado el dia: '+moment().format("Do")+ ' de '+moment().format("MMMM")+' del año '+moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ea nihil eum? Veritatis accusantium ex ab nam repudiandae, facere non adipisci maiores asperiores qui molestiae, explicabo vero suscipit dolore corrupti.Iure sequi soluta, autem veritatis sapiente illo, modi voluptatem neque nemo vero debitis. Et voluptate exercitationem incidunt, eligendi numquam autem soluta molestias voluptatum nostrum molestiae iste placeat natus fugit repellat.'
            },
            {
                title: "Prueba de titulo 2",
                date: 'Publicado el dia: '+moment().format("Do")+ ' de '+moment().format("MMMM")+' del año '+moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ea nihil eum? Veritatis accusantium ex ab nam repudiandae, facere non adipisci maiores asperiores qui molestiae, explicabo vero suscipit dolore corrupti.Iure sequi soluta, autem veritatis sapiente illo, modi voluptatem neque nemo vero debitis. Et voluptate exercitationem incidunt, eligendi numquam autem soluta molestias voluptatum nostrum molestiae iste placeat natus fugit repellat.'
            },
            {
                title: "Prueba de titulo 3",
                date: 'Publicado el dia: '+moment().format("Do")+ ' de '+moment().format("MMMM")+' del año '+moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ea nihil eum? Veritatis accusantium ex ab nam repudiandae, facere non adipisci maiores asperiores qui molestiae, explicabo vero suscipit dolore corrupti.Iure sequi soluta, autem veritatis sapiente illo, modi voluptatem neque nemo vero debitis. Et voluptate exercitationem incidunt, eligendi numquam autem soluta molestias voluptatum nostrum molestiae iste placeat natus fugit repellat.'
            },
            {
                title: "Prueba de titulo 4",
                date: 'Publicado el dia: '+moment().format("Do")+ ' de '+moment().format("MMMM")+' del año '+moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ea nihil eum? Veritatis accusantium ex ab nam repudiandae, facere non adipisci maiores asperiores qui molestiae, explicabo vero suscipit dolore corrupti.Iure sequi soluta, autem veritatis sapiente illo, modi voluptatem neque nemo vero debitis. Et voluptate exercitationem incidunt, eligendi numquam autem soluta molestias voluptatum nostrum molestiae iste placeat natus fugit repellat.'
            },
            {
                title: "Prueba de titulo 5",
                date: 'Publicado el dia: '+moment().format("Do")+ ' de '+moment().format("MMMM")+' del año '+moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ea nihil eum? Veritatis accusantium ex ab nam repudiandae, facere non adipisci maiores asperiores qui molestiae, explicabo vero suscipit dolore corrupti.Iure sequi soluta, autem veritatis sapiente illo, modi voluptatem neque nemo vero debitis. Et voluptate exercitationem incidunt, eligendi numquam autem soluta molestias voluptatum nostrum molestiae iste placeat natus fugit repellat.'
            },
            {
                title: "Prueba de titulo 6",
                date: 'Publicado el dia: '+moment().format("Do")+ ' de '+moment().format("MMMM")+' del año '+moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ea nihil eum? Veritatis accusantium ex ab nam repudiandae, facere non adipisci maiores asperiores qui molestiae, explicabo vero suscipit dolore corrupti.Iure sequi soluta, autem veritatis sapiente illo, modi voluptatem neque nemo vero debitis. Et voluptate exercitationem incidunt, eligendi numquam autem soluta molestias voluptatum nostrum molestiae iste placeat natus fugit repellat.'
            }
        ];
        posts.forEach((element, index)=>{
                var post = `
                    <article class="post">
                        <h2>${element.title}</h2>
                        <span class="date">${element.date}</span>
                        <p>${element.content}</p>
                        <a href="http://" class="button-more">Leer mas</a>
                    </article>
                `;
            $("#posts").append(post);
        });
    }
    //SELECTOR DE TEMA
    //CAMBIAR DE TEMA MEDIANTE LOCALSTORAGE
    var theme = $("#theme");
    $("#to-green").click(function(){
        theme.attr("href", "css/green.css");
    });
    $("#to-red").click(function(){
        theme.attr("href", "css/red.css");
    });
    $("#to-blue").click(function(){
        theme.attr("href", "css/blue.css");
    });
    //Scroll arriba de la web

    $('.subir').click(function(e){
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0

        }, 2000);

        return false;

    });

    //Login falso

    $("#login form").submit(function(){
        var form_name = $("#form_name").val();
        localStorage.setItem("form_name", form_name);
    });
    var form_name = localStorage.getItem("form_name");
    if(form_name != null && form_name != "undefined")
    {
        var about_parrafo = $("#about p");

        about_parrafo.html("<strong> Bienvenido," + form_name+ "</strong>");
        about_parrafo.append("<a href='' id='logout'> Cerrar Sesion </a>");
        $("#login").hide();

        $("#logout").click(function(){
            localStorage.clear();
            location.reload();
            
        });

    }
    //acordeon
    if(window.location.href.indexOf('about') > -1){
        $("#acordeon").accordion();

    }
    //reloj
    if(window.location.href.indexOf('reloj') > -1){

        setInterval(() => {
            var reloj = moment().format("h:mm:ss");
            $("#reloj").html(reloj);
        }, 1000);

            
    }
    //validacion formulario
    if(window.location.href.indexOf('contact') > -1){
        $("form input[name='date']").datepicker({
            dateFormat: 'dd-mm-yy'
        });
        $.validate({
            lang: 'es',
            errorMessagePosition: 'top',
            scrollToTopOnError: true
        });
    }


   
});