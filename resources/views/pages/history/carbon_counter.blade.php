
<style>
.counter{
    color: #fff;
    font-family: 'Poppins', sans-serif;
    text-align: center;
    width: 210px;
    margin: 0 auto;
}
.counter .counter-value{
    font-size: 30px;
    font-weight: 600;
    line-height: 120px;
    width: 130px;
    height: 130px;
    margin: 0 auto 20px;
    border: 8px solid #c60505;
    border-radius: 100px;
    display: block;
    position: relative;
    z-index: 1;
}
.counter .counter-value:before,
.counter .counter-value:after{
    content: "";
    background: linear-gradient(to top left,#c60505,#510101);
    width: 85%;
    height: 85%;
    border-radius: 50%;
    transform: translateX(-50%) translateY(-50%);
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: -1;
}
.counter .counter-value:after{
    transform: translateX(-50%) translateY(-50%) rotate(180deg);
    width: 75%;
    height: 75%;
}
.counter .counter-content{
    background: linear-gradient(to right,#c60505,#510101);
    padding: 33px 10px 23px;
    border-radius: 0 0 50px 50px;
    position: relative;
}
.counter .counter-content:before{
    content: "";
    background:#780304;
    width: 100%;
    height: 30px;
    border-radius: 50%;
    position: absolute;
    top: -15px;
    left: 0;
}
.counter .counter-icon{
    font-size: 40px;
    line-height: 40px;
    margin: 0 0 13px;
}
.counter h3{
    font-size: 15px;
    font-weight: 500;
    text-transform: capitalize;
    letter-spacing: 0.5px;
    margin: 0;
}

.counter_div{
    padding-left: 30%;
    padding-top: 20%;
}
.counter.green .counter-content{ background: linear-gradient(to right,#b7d952,#429a13);}
.counter.green .counter-content:before{ background:#429a13;}
.counter.green .counter-value{ border-color: #b7d952; }
.counter.green .counter-value:before,
.counter.green .counter-value:after{ background: linear-gradient(to top left,#b7d952,#429a13);}

@media screen and (max-width:990px){
    .counter{ margin-bottom: 40px; }
}   
</style>

<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-6 counter_div">
            <div class="counter green">
                <span class="counter-value">{{$co2_saved}}</span>
                <div class="counter-content">
                    <div class="counter-icon">
                        <i class="fa fa-rocket"></i>
                    </div>
                    <h3>Saved amount of CO2</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" >
$(document).ready(function(){
    $('.counter-value').each(function(){
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        },{
            duration: 3500,
            easing: 'swing',
            step: function (now){
                $(this).text(Math.ceil(now));
            }
        });
    });
});
</script>
