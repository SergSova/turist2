<?php

    /* @var $this yii\web\View */

    use app\models\LoginForm;
    use macgyer\yii2materializecss\lib\Html;

    $this->title = 'Добро пожаловать, человек!';
?>
    <div class="card-panel">
        <?=\app\widgets\GalleryWidget\GalleryWidget::widget()?>

        <article class="main-items">
            <div id="news_list">
                <section class="items"><h2><a lc="229" href="//www.ukr.net/news/main.html">Головне</a></h2><!--noindex-->
                    <ul class="top-news-list">
                        <li><a href="http://www.dw.com/ru/в-гонконге-проходят-парламентские-выборы/a-19525437?maca=rus-rss_rus_UkrNet_All-4190-xml"
                               nc="48567607,13,26510634" target="_blank" rel="nofollow">В Гонконге проходят парламентские выборы</a> <span>(Deutsche Welle)</span>
                        </li>
                        <li><a href="http://interfax.com.ua/news/general/367673.html" nc="48567550,13,26510812" target="_blank" rel="nofollow">Боевики
                                за
                                субботу 16 раз обстреляли позиции сил АТО – штаб</a> <span>(Интерфакс-Украина)</span></li>
                        <li><a href="http://www.ukrinform.ua/rubric-abroad/2077132-ssa-ta-kitaj-zaklikaut-priednuvatisa-do-parizkoi-ugodi.html"
                               nc="48567402,13,26510714" target="_blank" rel="nofollow">США та Китай закликають приєднуватися до Паризької угоди</a>
                            <span>(Укрінформ)</span></li>
                    </ul><!--/noindex-->
                    <div class="more_news"><a lc="230" href="//www.ukr.net/news/main.html">всі головні події дня</a></div>
                </section>
                <section class="items"><h2><a lc="810" href="//www.ukr.net/news/politika.html">Політика</a></h2><!--noindex-->
                    <div class="item">
                        <time>03:45</time>
                        <div class="item-title"><a href="https://www.facenews.ua/news/2016/332508/" nc="48567216,12,26510167" target="_blank"
                                                   rel="nofollow">Польша и Великобритания выступили за сохранение санкций против России</a> <span>(Facenews)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>03:35</time>
                        <div class="item-title"><a href="http://www.pravda.com.ua/news/2016/09/4/7119517/" nc="48567204,12,26501354" target="_blank"
                                                   rel="nofollow">Дочка Умерова: Українська влада напряму з нами не контактує</a> <span>(Українська правда)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>00:14</time>
                        <div class="item-title"><a
                                href="http://expres.ua/news/2016/09/04/201007-otrymannya-bezvizovogo-rezhymu-zalyshylosya-zovsim-nebagato"
                                nc="48566713,12,26509303" target="_blank" rel="nofollow">До отримання безвізового режиму залишилося зовсім
                                небагато</a>
                            <span>(Експрес online)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>21:39</time>
                        <div class="item-title"><a
                                href="http://glavcom.ua/news/kilka-desyatkiv-elektronnih-deklaraciy-vzhe-zyavilis-u-jedinomu-rejestri-370650.html"
                                nc="48565493,12,26509247" target="_blank" rel="nofollow">Кілька десятків електронних декларацій вже з’явились у
                                єдиному
                                реєстрі</a> <span>(Главком)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>21:25</time>
                        <div class="item-title"><a
                                href="http://zaxid.net/news/showNews.do?mizhnarodni_organizatsiyi_zaklikali_rosiyu_vipustiti_z_krimu_hvorogo_zhurnalista&amp;objectId=1402618"
                                nc="48565374,12,26508685" target="_blank" rel="nofollow">Міжнародні організації закликали Росію випустити з Криму
                                хворого
                                журналіста</a> <span>(Zaxid.net)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="796" href="//www.ukr.net/news/politika.html">всі політичні новини України</a></div>
                </section>
                <section class="items"><h2><a lc="811" href="//www.ukr.net/news/jekonomika.html">Економіка</a></h2><!--noindex-->
                    <div class="item">
                        <time>07:02</time>
                        <div class="item-title"><a
                                href="http://domik.ua/novosti/smozhet-li-ukraina-izbezhat-kraxa-bez-deneg-mvf-mneniya-ekonomistov-n247851.html"
                                nc="48567613,3,26510850" target="_blank" rel="nofollow">Сможет ли Украина избежать краха без денег МВФ: мнения
                                экономистов</a> <span>(Domik.ua)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:15</time>
                        <div class="item-title"><a
                                href="http://biz.nv.ua/ukr/markets/v-opek-nazvala-neprijnjatnimi-sogodnishni-tsini-na-naftu-212019.html"
                                nc="48567467,3,26510757" target="_blank" rel="nofollow">ОПЕК назвала "неприйнятними" сьогоднішні ціни на нафту</a>
                            <span>(Новое время)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>05:05</time>
                        <div class="item-title"><a href="http://newsoboz.org/ekonomika/s-p-snizilo-reyting-kieva-03092016102021"
                                                   nc="48567342,3,26504859"
                                                   target="_blank" rel="nofollow">Рейтинговое агентство S&amp;P снизило рейтинг Киева</a>
                            <span>(NewsOboz)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>01:11</time>
                        <div class="item-title"><a href="http://ua.today/news/politics/kabmin_ustanovil_nadbavku_k_zarplate_v_voennyh_liceyah"
                                                   nc="48566928,3,26508852" target="_blank" rel="nofollow">Кабмин установил надбавку к зарплате в
                                военных
                                лицеях</a> <span>(UAtoday)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>00:32</time>
                        <div class="item-title"><a href="https://www.facenews.ua/news/2016/332507/" nc="48566797,3,26508253" target="_blank"
                                                   rel="nofollow">Гройсман выступает против консолидации средств в Киев</a> <span>(Facenews)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="797" href="//www.ukr.net/news/jekonomika.html">всі новини економіки та фінансів</a></div>
                </section>
                <section class="items"><h2><a lc="812" href="//www.ukr.net/news/proisshestvija.html">Події</a></h2><!--noindex-->
                    <div class="item">
                        <time>07:04</time>
                        <div class="item-title"><a href="http://dpchas.com.ua/kriminal/v-dnepre-muzh-zhestoko-izbil-zhenu-foto"
                                                   nc="48567620,2,26510852"
                                                   target="_blank" rel="nofollow">В Днепре муж жестоко избил жену (фото)</a> <span>(Днепр Час)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>07:02</time>
                        <div class="item-title"><a href="http://pl.com.ua/v-chernigovskoj-oblasti-mat-ostavila-na-kladbishhe-umirat-novorozhdennogo/"
                                                   nc="48567606,2,26507922" target="_blank" rel="nofollow">В Черниговской области мать оставила на
                                кладбище умирать новорожденного</a> <span>(Публичные люди)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>07:02</time>
                        <div class="item-title"><a href="http://sprotyv.info/node/50449" nc="48567608,2,26508043" target="_blank" rel="nofollow">Журналист
                                сообщил о странных «маневрах» ОБСЕ на Донбассе. ФОТО</a> <span>(Информационное сопротивление)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:55</time>
                        <div class="item-title"><a href="http://glavcom.ua/kyiv/news/u-buchi-zgoriv-restoran-370680.html" nc="48567570,2,26510603"
                                                   target="_blank" rel="nofollow">У Бучі згорів ресторан</a> <span>(Главком)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>05:46</time>
                        <div class="item-title"><a
                                href="http://telegraf.com.ua/ukraina/mestnyiy/2796342-v-rayone-ato-zaderzhali-pochti-500-avto-s-nezakonnyimi-gruzami.html"
                                nc="48567397,2,26504247" target="_blank" rel="nofollow">В районе АТО задержали почти 500 авто с незаконными
                                грузами</a>
                            <span>(Телеграф)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="798" href="//www.ukr.net/news/proisshestvija.html">всі новини подій, аварій, катастроф</a></div>
                </section>
                <section class="items"><h2><a lc="817" href="//www.ukr.net/news/society.html">Суспільство</a></h2><!--noindex-->
                    <div class="item">
                        <time>06:33</time>
                        <div class="item-title"><a href="http://zik.ua/news/2016/09/04/31_rik_tomu_pomer_vyznachnyy_ukrainskyy_poet_vasyl_stus_832012"
                                                   nc="48567516,5,26510369" target="_blank" rel="nofollow">31 рік тому помер визначний український
                                поет
                                Василь Стус</a> <span>(Zik)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:30</time>
                        <div class="item-title"><a href="http://newsoboz.org/obshchestvo/groysman-uspokoil-budushchih-magistrov-03092016004725"
                                                   nc="48567506,5,26501510" target="_blank" rel="nofollow">Премьер успокоил будущих магистров</a>
                            <span>(NewsOboz)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:00</time>
                        <div class="item-title"><a href="http://sprotyv.info/node/50445" nc="48567417,5,26509031" target="_blank" rel="nofollow">Курсанты
                                львовской «сухопутки» приняли присягу на верность народу Украины. ВИДЕО. ФОТО</a>
                            <span>(Информационное сопротивление)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>05:50</time>
                        <div class="item-title"><a
                                href="http://www.segodnya.ua/politics/pnews/25-let-nazad-nad-zdaniem-verhovnoy-rady-podnyali-zhelto-goluboy-flag-748660.html"
                                nc="48567404,5,26510284" target="_blank" rel="nofollow">25 лет назад над зданием Верховной Рады подняли желто-голубой
                                флаг</a> <span>(Сегодня.ua)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>04:26</time>
                        <div class="item-title"><a
                                href="http://hronika.info/rossija/168077-uchastnik-piketa-v-zaschitu-umerova-zaderzhan-v-pitere.html"
                                nc="48567282,5,26509955" target="_blank" rel="nofollow">Участник пикета в защиту Умерова задержан в
                                Питере</a> <span>(Hronika.info)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="803" href="//www.ukr.net/news/society.html">всі новини розділу Суспільство</a></div>
                </section>
                <section class="items regions" id="cat_16">
                    <div class="h2"><a href="javascript:void(0)" onclick="return false;">Київські Новини</a> <span></span>
                        <div class="regions-list">
                            <div class="list-rows">
                                <h2 class="title"><a href="javascript:void(0)" onclick="return false;">Київські Новини</a> <span></span>
                                    <div class="unshadow"></div>
                                </h2>
                                <div class="areg"><a href="javascript:News.region(9)">Київ</a></div>
                                <div><a href="javascript:News.region(11)">Крим</a></div>
                                <div><a href="javascript:News.region(1)">Вінниця</a></div>
                                <div><a href="javascript:News.region(2)">Волинь</a></div>
                                <div><a href="javascript:News.region(3)">Дніпро</a></div>
                                <div><a href="javascript:News.region(4)">Донецьк</a></div>
                                <div><a href="javascript:News.region(5)">Житомир</a></div>
                                <div><a href="javascript:News.region(6)">Закарпаття</a></div>
                                <div><a href="javascript:News.region(7)">Запоріжжя</a></div>
                                <div><a href="javascript:News.region(8)">Івано-Франківськ</a></div>
                                <div><a href="javascript:News.region(10)">Кропивницький</a></div>
                                <div><a href="javascript:News.region(12)">Луганськ</a></div>
                                <div><a href="javascript:News.region(13)">Львів</a></div>
                                <div><a href="javascript:News.region(14)">Миколаїв</a></div>
                                <div><a href="javascript:News.region(15)">Одеса</a></div>
                                <div><a href="javascript:News.region(16)">Полтава</a></div>
                                <div><a href="javascript:News.region(17)">Рівне</a></div>
                                <div><a href="javascript:News.region(18)">Суми</a></div>
                                <div><a href="javascript:News.region(19)">Тернопіль</a></div>
                                <div><a href="javascript:News.region(20)">Харків</a></div>
                                <div><a href="javascript:News.region(21)">Херсон</a></div>
                                <div><a href="javascript:News.region(22)">Хмельницький</a></div>
                                <div><a href="javascript:News.region(23)">Черкаси</a></div>
                                <div><a href="javascript:News.region(24)">Чернігів</a></div>
                                <div><a href="javascript:News.region(25)">Чернівці</a></div>
                                <i class="b-cl-block"></i></div>
                        </div>
                    </div><!--noindex-->
                    <div class="item">
                        <time>06:46</time>
                        <div class="item-title"><a
                                href="http://vedomosti-ua.com/34114-v-kieve-iz-za-podorozhaniya-elektroenergii-budut-otklyuchat-nochyu-svet-na-ulicah.html"
                                rc="48567543,9,26510807" target="_blank" rel="nofollow">В Киеве из-за подорожания электроэнергии будут отключать ночью
                                свет на улицах</a> <span>(Ведомости-Украина)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>05:48</time>
                        <div class="item-title"><a
                                href="http://www.unian.ua/society/1501938-u-kievi-volonteri-viyshli-na-nichne-polyuvannya-na-pyanih-vodijiv-video.html"
                                rc="48567401,9,26510713" target="_blank" rel="nofollow">У Києві волонтери вийшли на "нічне полювання" на п’яних
                                водіїв</a>
                            <span>(Уніан)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>04:16</time>
                        <div class="item-title"><a href="http://gazeta.ua/articles/kiev-life/_u-centri-kiyeva-goriv-restoran/720906"
                                                   rc="48567261,9,26509768" target="_blank" rel="nofollow">У центрі Києва горів ресторан</a> <span>(Gazeta.ua)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>03:01</time>
                        <div class="item-title"><a
                                href="http://veroyatno.com.ua/news/v-kieve-zakupyat-e-lektronny-e-uchebniki-dlya-uchenikov-5-klassov-14-shkol/"
                                rc="48567156,9,26502631" target="_blank" rel="nofollow">В Киеве закупят электронные учебники для учеников 5 классов 14
                                школ</a> <span>(Вероятно)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>00:45</time>
                        <div class="item-title"><a
                                href="http://www.zagorodna.com/ru/stati/radi-ekonomii-v-kieve-budut-vykliuchat-nochnoe-osveschenie-ulic.html"
                                rc="48566843,9,26510387" target="_blank" rel="nofollow">Ради экономии в Киеве будут выключать ночное освещение
                                улиц</a>
                            <span>(Zagorodna.com)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="804" href="//www.ukr.net/news/kiev.html">всі новини розділу</a></div>
                </section>
                <section class="items"><h2><a lc="813" href="//www.ukr.net/news/tehnologii.html">Технології</a></h2><!--noindex-->
                    <div class="item">
                        <time>07:01</time>
                        <div class="item-title"><a href="http://internetua.com/produaser-NHL-17-nadeetsya-vnov-uvidet-etu-sportivnuua-seriua-na-PC"
                                                   nc="48567605,7,26510847" target="_blank" rel="nofollow">Продюсер NHL 17 надеется вновь увидеть эту
                                спортивную серию на PC</a> <span>(internetua)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>07:00</time>
                        <div class="item-title"><a
                                href="http://www.gogetnews.info/news/techno/135584-v-seti-poyavilis-pervye-snimki-playstation-4-neo-foto.html"
                                nc="48567597,7,26510841" target="_blank" rel="nofollow">В Сети появились первые снимки PlayStation 4 NEO (ФОТО)</a>
                            <span>(GoGetNews.info)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:56</time>
                        <div class="item-title"><a href="http://navkolonas.com/archives/17923" nc="48567572,7,26502561" target="_blank"
                                                   rel="nofollow">У
                                США почали розробку нового винищувача</a> <span>(Navkolonas.com)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:50</time>
                        <div class="item-title"><a href="http://newsyou.info/vmeste-s-iphone-7-apple-predstavit-naushniki-beats"
                                                   nc="48567556,7,26506915"
                                                   target="_blank" rel="nofollow">Вместе с iPhone 7 Apple представит наушники Beats</a>
                            <span>(Newsyou)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:36</time>
                        <div class="item-title"><a href="http://glavcom.ua/video/magazin-maybutnogo-vidkrivsya-v-berlini-370677.html"
                                                   nc="48567524,7,26510795" target="_blank" rel="nofollow">Магазин майбутнього відкрився в Берліні</a>
                            <span>(Главком)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="799" href="//www.ukr.net/news/tehnologii.html">всі новини інформаційних технологій</a></div>
                </section>
                <section class="items"><h2><a lc="829" href="//www.ukr.net/news/science.html">Наука</a></h2><!--noindex-->
                    <div class="item">
                        <time>07:00</time>
                        <div class="item-title"><a href="http://www.percare.ru/news/11590/" nc="48567595,22,26510839" target="_blank" rel="nofollow">Ученые
                                определили новый вид зависимости - телефонную наркоманию</a> <span>(Percare)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:25</time>
                        <div class="item-title"><a href="http://www.bagnet.org/news/world/305892" nc="48567492,22,26502972" target="_blank"
                                                   rel="nofollow">В Австралии поймали гигантского крокодила-убийцу</a> <span>(Багнет)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>04:30</time>
                        <div class="item-title"><a href="http://new-s.com.ua/uncategorized/stvoreno_najpotuzhnishyj_sviti_mikroskop_06565.html"
                                                   nc="48567288,22,26510632" target="_blank" rel="nofollow">Американські вчені створили найпотужніший
                                у
                                світі мікроскоп</a> <span>(New-s.com.ua)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>03:40</time>
                        <div class="item-title"><a
                                href="http://www.gogetnews.info/news/science/135562-nemeckiy-uchenyy-predlozhil-zaseivat-drugie-planety-zhiznyu.html"
                                nc="48567210,22,26510605" target="_blank" rel="nofollow">Немецкий ученый предложил «засеивать» другие планеты
                                жизнью</a>
                            <span>(GoGetNews.info)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>03:04</time>
                        <div class="item-title"><a
                                href="http://ru.golos.ua/suspilstvo/len_yavlyaetsya_odnim_iz_priznakov_vyisokogo_intellekta__uchenyie_9192"
                                nc="48567163,22,26510581" target="_blank" rel="nofollow">Лень является одним из признаков высокого интеллекта —
                                ученые</a>
                            <span>(ГолосUA)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="830" href="//www.ukr.net/news/science.html">всі новини науки</a></div>
                </section>
                <section class="items"><h2><a lc="814" href="//www.ukr.net/news/avto.html">Авто</a></h2><!--noindex-->
                    <div class="item">
                        <time>06:17</time>
                        <div class="item-title"><a href="http://telegraf.com.ua/auto/2796352-debyut-hyndai-verna-novogo-pokoleniya-foto.html"
                                                   nc="48567474,20,26488471" target="_blank" rel="nofollow">Дебют Hyndai Verna нового поколения
                                (Фото)</a>
                            <span>(Телеграф)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>05:13</time>
                        <div class="item-title"><a href="http://mmr.net.ua/autoworld/news/31734" nc="48567355,20,26504588" target="_blank"
                                                   rel="nofollow">Завод
                                у Черкасах співпрацює з німецьким автовиробником (Відео)</a> <span>(MMR)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>02:40</time>
                        <div class="item-title"><a href="http://www.gogetnews.info/news/techno/135551-mercedes-gle-zamechen-na-testah.html"
                                                   nc="48567097,20,26510545" target="_blank" rel="nofollow">Mercedes GLE замечен на тестах</a> <span>(GoGetNews.info)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>01:02</time>
                        <div class="item-title"><a
                                href="http://f1analytic.com/autonews/15461novii-i-stilnii-pikap-fiat-fullback-vihodit-na-rinok-foto.html"
                                nc="48566912,20,26510430" target="_blank" rel="nofollow">Новий і стильний пікап Fiat Fullback виходить на ринок
                                (+ФОТО)</a> <span>(Формула-1)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>00:31</time>
                        <div class="item-title"><a
                                href="http://avtovod.org.ua/news/736469101-ukrains-kiy-avtorinok-yak-zminilisya-tendencii-v-ostanniy-misyac-lita.html"
                                nc="48566794,20,26504173" target="_blank" rel="nofollow">Український авторинок: як змінилися тенденції в останній
                                місяць
                                літа</a> <span>(Автовод)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="800" href="//www.ukr.net/news/avto.html">всі автоновини</a></div>
                </section>
                <section class="items"><h2><a lc="815" href="//www.ukr.net/news/sport.html">Спорт</a></h2><!--noindex-->
                    <div class="item">
                        <time>07:03</time>
                        <div class="item-title"><a
                                href="https://football24.ua/news/showNews.do?natspolitsiya_ukrayini_sogodni_poverne_vikradenu_mashinu_legioneru_yakiy_pokinuv_dinamo&amp;objectId=334410"
                                nc="48567614,4,26510851" target="_blank" rel="nofollow">Нацполіція України сьогодні поверне викрадену машину
                                легіонеру,
                                який покинув "Динамо"</a> <span>(Футбол 24)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>07:02</time>
                        <div class="item-title"><a
                                href="http://f1analytic.com/video/15468peremozhne-kolo-hemiltona-u-kvalifikacii-v-italii-2016-video.html"
                                nc="48567612,4,26510849" target="_blank" rel="nofollow">Переможне коло Хемілтона у кваліфікації в Італії-2016
                                (ВІДЕО)</a>
                            <span>(Формула-1)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:55</time>
                        <div class="item-title"><a href="https://sportarena.com/2016/09/04/marchenko-proshel-kirosa-i-vpervye-sygraet-v-1-8-finala/"
                                                   nc="48567566,4,26510823" target="_blank" rel="nofollow">Марченко прошел Кирьоса и впервые сыграет в
                                1/8
                                финала Шлема</a> <span>(Sportarena)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:47</time>
                        <div class="item-title"><a
                                href="http://24boxing.com.ua/news/27729dzhekson-bii-kovalov-vord-mozhe-trivati-vsyu-distanciyu.html"
                                nc="48567548,4,26510810" target="_blank" rel="nofollow">Джексон: Бій Ковальов-Ворд може тривати всю
                                дистанцію</a> <span>(24boxing.com.ua)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:32</time>
                        <div class="item-title"><a href="http://footballgazeta.com/transfers/grizmann-pereide-v-angliiskii-grand.html"
                                                   nc="48567513,4,26510786" target="_blank" rel="nofollow">Грізманн перейде в англійський гранд</a>
                            <span>(Football Gazeta)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="801" href="//www.ukr.net/news/sport.html">всі спортивні новини: футбол, бокс, хокей...</a></div>
                </section>
                <section class="items"><h2><a lc="816" href="//www.ukr.net/news/zdorove.html">Здоров'я</a></h2><!--noindex-->
                    <div class="item">
                        <time>07:05</time>
                        <div class="item-title"><a href="http://newsyou.info/shest-produktov-kotorye-nuzhno-est-ezhednevno" nc="48567622,14,26510854"
                                                   target="_blank" rel="nofollow">Шесть продуктов, которые нужно есть ежедневно</a>
                            <span>(Newsyou)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>07:05</time>
                        <div class="item-title"><a href="http://novosti-n.org/ukraine/read/136933.html" nc="48567624,14,26509821" target="_blank"
                                                   rel="nofollow">Названы продукты, помогающие строить карьеру</a> <span>(Новости N)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:46</time>
                        <div class="item-title"><a href="http://healthinfo.ua/articles/novosti_zdorovia/30814" nc="48567545,14,26510809"
                                                   target="_blank"
                                                   rel="nofollow">Названы золотые правила профилактики рака</a> <span>(Health info)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:44</time>
                        <div class="item-title"><a
                                href="http://headinsider.net/2016/09/04/dlya-lecheniya-etix-zabolevanij-strogo-rekomenduetsya-koshache-urchanie/"
                                nc="48567536,14,26510803" target="_blank" rel="nofollow">Для лечения этих заболеваний строго рекомендуется кошачье
                                урчание</a> <span>(Headinsider)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:40</time>
                        <div class="item-title"><a href="http://www.gogetnews.info/news/health/135594-vino-meshaet-zhenschinam-zaberemenet.html"
                                                   nc="48567527,14,26510797" target="_blank" rel="nofollow">Вино мешает женщинам забеременеть</a>
                            <span>(GoGetNews.info)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="802" href="//www.ukr.net/news/zdorove.html">всі новини медицини, краси та косметології</a></div>
                </section>
                <section class="items"><h2><a lc="819" href="//www.ukr.net/news/show_biznes.html">Шоу-бізнес</a></h2><!--noindex-->
                    <div class="item">
                        <time>07:05</time>
                        <div class="item-title"><a
                                href="http://nv.ua/ukr/techno/voskresnoje-chtivo/nedilnij-chtivo-5-gerojiv-komiksiv-zasnovanih-na-realnih-ljudjah-208158.html"
                                nc="48567623,21,26510855" target="_blank" rel="nofollow">Недільне чтиво. 5 героїв коміксів, заснованих на реальних
                                людях</a> <span>(Новое время)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>07:00</time>
                        <div class="item-title"><a href="http://www.multikino.com/ru/news/?id=13378" nc="48567593,21,26510837" target="_blank"
                                                   rel="nofollow">Том Хэнкс для журнала The Rake (ФОТО)</a> <span>(Multikino)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:35</time>
                        <div class="item-title"><a
                                href="http://newsoboz.org/obshchestvo/nikuda-bez-lyubimoy-leonardo-dikaprio-otpravilsya-na-shoping-02092016175528"
                                nc="48567519,21,26510791" target="_blank" rel="nofollow">Леонардо ДиКаприо даже на шопинг идет с любимой</a> <span>(NewsOboz)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:25</time>
                        <div class="item-title"><a
                                href="http://www.segodnya.ua/culture/stars/tom-hiddlston-nazval-svoi-lyubimye-romanticheskie-komedii-748003.html"
                                nc="48567495,21,26510774" target="_blank" rel="nofollow">Том Хиддлстон назвал свои любимые романтические комедии</a>
                            <span>(Сегодня.ua)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>04:26</time>
                        <div class="item-title"><a
                                href="http://hronika.info/kultura/168070-olga-cibulskaya-rasskazala-pochemu-ne-razdevaetsya-dlya-muzhskih-zhurnalov.html"
                                nc="48567279,21,26503803" target="_blank" rel="nofollow">Ольга Цибульская рассказала, почему не раздевается для
                                мужских
                                журналов</a> <span>(Hronika.info)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="805" href="//www.ukr.net/news/show_biznes.html">всі новини розділу Шоу-бізнес</a></div>
                </section>
                <section class="items"><h2><a lc="820" href="//www.ukr.net/news/za_rubezhom.html">За кордоном</a></h2><!--noindex-->
                    <div class="item">
                        <time>07:06</time>
                        <div class="item-title"><a href="http://ru.golos.ua/suspilstvo/v_vatikane_segodnya_kanoniziruyut_mat_terezu_8030"
                                                   nc="48567629,6,26509849" target="_blank" rel="nofollow">Ватикане канонизирует мать Терезу</a>
                            <span>(ГолосUA)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>07:05</time>
                        <div class="item-title"><a href="http://www.bbc.com/russian/news-37269505" nc="48567621,6,26510853" target="_blank"
                                                   rel="nofollow">Тереза Мэй пообещала Британии "непростые времена" в связи с "брекситом"</a> <span>(BBCRussian)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>07:03</time>
                        <div class="item-title"><a href="https://www.rbc.ua/rus/news/ssha-proizoshla-avariya-attraktsione-lunohod-1472952045.html"
                                                   nc="48567615,6,26510548" target="_blank" rel="nofollow">В США произошла авария на аттракционе
                                "Луноход", есть пострадавшие</a> <span>(РБК-Україна)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>07:02</time>
                        <div class="item-title"><a
                                href="http://telegraf.com.ua/mir/europa/2796386-v-londone-tyisyachi-lyudey-vyishli-na-marsh-protiv-vrexit.html"
                                nc="48567610,6,26510801" target="_blank" rel="nofollow">В Лондоне тысячи людей вышли на марш против Вrexit</a> <span>(Телеграф)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>07:01</time>
                        <div class="item-title"><a
                                href="http://xn--j1aidcn.org/%d0%b2%d1%82%d0%be%d1%80%d0%be%d0%b5-%d0%b7%d0%b0-%d0%b4%d0%b5%d0%bd%d1%8c-%d1%81%d0%b8%d0%bb%d1%8c%d0%bd%d0%be%d0%b5-%d0%b7%d0%b5%d0%bc%d0%bb%d0%b5%d1%82%d1%80%d1%8f%d1%81%d0%b5%d0%bd%d0%b8%d0%b5/"
                                nc="48567599,6,26510836" target="_blank" rel="nofollow">Второе за день сильное землетрясение в Оклахоме США вызвало
                                пожары
                                и разрушения</a> <span>(Укроп.org)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="806" href="//www.ukr.net/news/za_rubezhom.html">всі новини з-за кордону</a></div>
                </section>
                <section class="items"><h2><a lc="821" href="//www.ukr.net/news/kurezy.html">Курйози</a></h2><!--noindex-->
                    <div class="item">
                        <time>07:05</time>
                        <div class="item-title"><a href="http://www.segodnya.ua/world/v-rossii-aktivist-sazhaet-v-yamy-na-dorogah-luk-748679.html"
                                                   nc="48567627,17,26510565" target="_blank" rel="nofollow">В России активист сажает в ямы на дорогах
                                лук</a> <span>(Сегодня.ua)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>07:02</time>
                        <div class="item-title"><a href="http://novosti-n.org/ukraine/read/136928.html" nc="48567609,17,26510069" target="_blank"
                                                   rel="nofollow">Умная черепаха нашла выход из затруднительного положения. ВИДЕО</a>
                            <span>(Новости N)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>04:26</time>
                        <div class="item-title"><a
                                href="http://hronika.info/kurjozy/168078-ironichnye-otkrytki-kotorye-tochno-podnimut-vam-nastroenie.html"
                                nc="48567281,17,26510280" target="_blank" rel="nofollow">Ироничные открытки, которые точно поднимут вам настроение</a>
                            <span>(Hronika.info)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>03:39</time>
                        <div class="item-title"><a href="http://www.akcent.org.ua/prem-yera-kanady-zobrazy-ly-u-komiksah-foto/"
                                                   nc="48567207,17,26486314"
                                                   target="_blank" rel="nofollow">Прем’єра Канади зобразили у коміксах (фото)</a> <span>(Інформаційний Акцент)</span>
                        </div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>00:01</time>
                        <div class="item-title"><a href="http://lypa.com.ua/2016/09/04/smishno-do-sliz-dobirka-epichnyh-provaliv-ta-nevdach-foto/"
                                                   nc="48566654,17,26510268" target="_blank" rel="nofollow">Смішно до сліз: добірка епічних провалів
                                та
                                невдач (ФОТО)</a> <span>(Тернопільська Липа)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="807" href="//www.ukr.net/news/kurezy.html">всі забавні, курйозні новини</a></div>
                </section>
                <section class="items"><h2><a lc="822" href="//www.ukr.net/news/fotoreportazh.html">Фоторепортаж</a></h2><!--noindex-->
                    <div class="item">
                        <time>07:00</time>
                        <div class="item-title"><a href="http://novosti-n.org/ukraine/read/136923.html" nc="48567584,8,26504090" target="_blank"
                                                   rel="nofollow">Золотая эпоха мотелей в США в 1960-х годах. ФОТО</a> <span>(Новости N)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>06:27</time>
                        <div class="item-title"><a
                                href="http://telegraf.com.ua/zhizn/zhurnal/2796361-effektnyie-primeryi-dizayna-stenyi-u-izgolovya-krovati-foto.html"
                                nc="48567496,8,26510775" target="_blank" rel="nofollow">Эффектные примеры дизайна стены у изголовья кровати (Фото)</a>
                            <span>(Телеграф)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>04:26</time>
                        <div class="item-title"><a href="http://hronika.info/fotoreportazhi/168066-roskoshnyy-dom-na-gollivudskih-holmah-foto.html"
                                                   nc="48567283,8,26502037" target="_blank" rel="nofollow">Роскошный дом на Голливудских холмах.
                                Фото</a>
                            <span>(Hronika.info)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>03:34</time>
                        <div class="item-title"><a
                                href="http://xn--j1aidcn.org/65-%d0%bb%d0%b5%d1%82%d0%bd%d1%8f%d1%8f-%d0%bf%d0%b5%d0%bd%d1%81%d0%b8%d0%be%d0%bd%d0%b5%d1%80%d0%ba%d0%b0-%d1%81-%d1%82%d0%b5%d0%bb%d0%be%d0%bc-20-%d0%bb%d0%b5%d1%82%d0%bd%d0%b5%d0%b9-%d0%bf%d0%bb/"
                                nc="48567201,8,26510602" target="_blank" rel="nofollow">65-летняя пенсионерка с телом 20-летней пленяет мужчин.
                                ФОТО</a>
                            <span>(Укроп.org)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>03:01</time>
                        <div class="item-title"><a href="http://www.bbc.com/russian/news-37269272" nc="48567157,8,26510578" target="_blank"
                                                   rel="nofollow">Гран-при на престижном фотоконкурсе достался работе о мигрантах</a>
                            <span>(BBCRussian)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="808" href="//www.ukr.net/news/fotoreportazh.html">всі фотоновини</a></div>
                </section>
                <section class="items"><h2><a lc="231" href="//www.ukr.net/news/video.html">Відео</a></h2><!--noindex-->
                    <div class="item">
                        <time>07:03</time>
                        <div class="item-title"><a
                                href="http://u-news.com.ua/36541-lyashko-sobirayuschiy-griby-zastavil-hohotat-internet-polzovateley-video.html"
                                nc="48567616,18,26493260" target="_blank" rel="nofollow">Ляшко, собирающий грибы, заставил хохотать
                                интернет-пользователей
                                (видео)</a> <span>(U-News)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>05:43</time>
                        <div class="item-title"><a
                                href="http://zik.ua/news/2016/09/04/u_sotsmerezhi_pokazaly_yak_vyglyadaie_teper_kolyshniy_kazantyp_832242"
                                nc="48567392,18,26510484" target="_blank" rel="nofollow">У соцмережі показали як виглядає тепер колишній КаZантип</a>
                            <span>(Zik)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>05:13</time>
                        <div class="item-title"><a
                                href="http://znaj.ua/news/world/60055/inoplanetyan-zapidozrili-v-stvorenni-idealno-kruglogo-ozera-video.html"
                                nc="48567356,18,26510686" target="_blank" rel="nofollow">Інопланетян запідозрили в створенні ідеально круглого озера
                                (відео)</a> <span>(Znaj.ua)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>02:16</time>
                        <div class="item-title"><a
                                href="http://ru.golos.ua/suspilstvo/jitel_nyuyorka_s_sekatorom_opolchilsya_na_selfipalki_video_9908"
                                nc="48567058,18,26510523" target="_blank" rel="nofollow">Житель Нью-Йорка с секатором ополчился на
                                селфи-палки (ВИДЕО)</a> <span>(ГолосUA)</span></div>
                        <div class="b-cl-block"></div>
                    </div>
                    <div class="item">
                        <time>02:16</time>
                        <div class="item-title"><a
                                href="http://hronika.info/videonovosti/168074-chudesnoe-prevoploschenie-devushki-v-kitayanku-afrikanku-i-indianku-video.html"
                                nc="48567060,18,26509326" target="_blank" rel="nofollow">Чудесное превоплощение девушки в китаянку, африканку и
                                индианку.
                                Видео</a> <span>(Hronika.info)</span></div>
                        <div class="b-cl-block"></div>
                    </div><!--/noindex-->
                    <div class="more_news"><a lc="232" href="//www.ukr.net/news/video.html">всі відео новини</a></div>
                </section>
            </div>
            <!--noindex--><!--/noindex-->            </article>
    </div>
