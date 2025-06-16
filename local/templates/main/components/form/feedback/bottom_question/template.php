<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die(); ?>


<section class="block__padd" >
            <div class="container">
                <div class="invite row align-items-stretch">
                    <div class="col-12 col-lg-8">
                        <div class="form__wrapper">
                            <div class="h2">Остались вопросы? Будем рады помочь!</div>
                            <form class="form" id="<?= $arParams["TOKEN"] ?>">
                                <div class="form__line row">
                                    <div class="col-12"><input class="form__input" type="text" placeholder="Имя*" name="NAME" /></div>
                                    <div class="col-12 col-md-6"><input class="form__input js--inputmask" type="tel" placeholder="Телефон*" name="PHONE" /></div>
                                    <div class="col-12 col-md-6"><input class="form__input" type="mail" name="EMAIL" placeholder="E-mail*" value="" /></div>
                                    <div class="col-12"><textarea class="form__input" name="TEXT" rows="3" placeholder="Сообщение"></textarea></div>
                                    <div class="col-12 col-lg-11"><label class="form__check form__check__mini"><input type="checkbox" checked="checked" /><span class="form__check__text">Нажимая кнопку «Отправить», я&nbsp;даю согласие на&nbsp;обработку своих персональных данных в&nbsp;соответствии с&nbsp;<a href="/policy/" target="_blank">Политикой конфиденциальности</a></span></label></div>
                                    <div class="col-12 "><button id="btn_<?= $arParams["TOKEN"] ?>" class="mbtn mbtn__primary mbtn__big d-block w-100" type="submit">Отправить</button></div>
                                </div>
                                <button id="send-btn_<?= $arParams["TOKEN"] ?>" style="display:none" class="mbtn mbtn__primary mbtn__small" data-fancybox-html="modal-send" data-src="#js--modal-order-ok">Форма отправлена</button>
                    <input type="text" hidden="" value="<?= $APPLICATION->GetCurDir() ?>" name="PAGE">
                    <input type="text" hidden="" value="остались вопросы?" name="TITLE">
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 d-none d-lg-block">
                        <div class="invite__img"><img src="/local/templates/main/img/img-invite.png" alt=""></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // form__input__error -->


    <?php
// CJSCore::Init(['masked_input']);
?>

<script>
    // BX.ready(function() {
    //     var result = new BX.MaskedInput({
    //         mask: '+7 999 999 99 99', // устанавливаем маску
    //         input: BX('PHONE'),
    //         placeholder: '-' // символ замены +7 ___ ___ __ __
    //     });
    //     result.setValue('+'); // устанавливаем значение
    // });


    // reject reload
    document.querySelector("#<?= $arParams["TOKEN"] ?>").addEventListener("submit", (event) => {
        event.preventDefault()
    });

    //valid
    function valid(e, name, text, regex = /.{1}/) {
       
        if (e.name == name) {
           
            if (!regex.test(e.value)) {
               
                if (!e.parentElement.querySelector("span")) {
                    e.className+=" form__input__error ";
                    // e.style = "border: 1px solid red"
                    // e.parentElement.innerHTML += `<span style="color:#000">${text}</span>`;
                }else{
                if (e.parentElement.querySelector(".iti__a11y-text")) {
                    e.className+=" form__input__error ";
                    // e.style = "border: 1px solid red"
                    // e.parentElement.parentElement.innerHTML += `<span style="color:#000">${text}</span>`;
                }
                if (e.parentElement.parentElement.querySelector("span")) {
                    e.parentElement.parentElement.querySelector("span").remove();
                    e.style = "";
                    e.classList.remove("form__input__error");
                }
                if (!e.parentElement.querySelector(".iti__a11y-text")) {
                    e.className+=" form__input__error ";
                    // e.style = "border: 1px solid red"
                    // e.parentElement.parentElement.innerHTML += `<span style="color:#000">${text}</span>`;
                }
            }
                window.FormStatus = false;
            } else {
                
                if (e.parentElement.querySelector("span")) {
                    e.parentElement.querySelector("span").remove();
                    e.style = "";
                }
            }
        }
    }

    
    document.querySelector("#btn_<?= $arParams["TOKEN"] ?>").addEventListener("click", async (event) => {
        // send ajax request with values of inputs
        window.FormStatus = true;
        valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='NAME']"), "NAME", "")
        // valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='CITY']"), "CITY", "Поле обязательно к заполнению")
        valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='EMAIL']"), "EMAIL", "")
        valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='PHONE']"), "PHONE", "", /^(\+7|7|8|[0-9])?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/)
        let curDir = document.location.protocol + '//' + document.location.host + document.location.pathname;
        let data = new FormData(document.querySelector("#<?= $arParams["TOKEN"] ?>"))
        data.append("TOKEN", "<?= $arParams["TOKEN"] ?>")
        data.append("PAGE", curDir)
        if (window.FormStatus) {
            let result = await fetch(curDir, {
                method: 'POST',
                body: data,
            }).then(response => {
                return response.text()
            }).then(data => {
                return data;
            })
            console.log(result)
            // document.querySelector(".is-close-btn").click()
            document.querySelector("#send-btn_<?= $arParams["TOKEN"] ?>").click()
            
        } else {
            window.FormStatus = true;
            valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='NAME']"), "NAME", "")
            valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='PHONE']"), "PHONE", "", /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/)
        }

    })
    ;


</script>

