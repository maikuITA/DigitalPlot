<?php

class BasicEntry
{

    /**
     *  Method to populate the database with basic entries.
     * @return void
     */
    public static function populateDb(): void
    {

        // User
        $u1 = new EUser(ADMIN, 'admin', 'admin123', 'Admin', 'Admin', '2003-04-18', 'Italy', 'Pescara', 'PE', '65125', 'Via Monte Saraceno', '11', 'admin@admin.com', '0000000000', 'Admin appassionato di tecnologia e gestione sistemi, sempre pronto a intervenire.');
        $u2 = new EUser(BASIC, 'mario.rossi', 'passMario1', 'Mario', 'Rossi', '1995-06-12', 'Italy', 'Roma', 'RM', '00100', 'Via Appia Nuova', '45', 'mario.rossi@example.com', '3201234567', "Mario Rossi, utente base di Roma, ama la musica e le passeggiate nei parchi.");
        $u3 = new EUser(READER, 'lisa.romano', 'lisaRead@24', 'Lisa', 'Romano', '1991-08-14', 'Italy', 'Trieste', 'TS', '34100', 'Via San Nicolò', '9', 'lisa.romano@example.com', '3275566888', "Lisa Romano, lettrice curiosa di Trieste, appassionata di libri e caffè.");
        $u4 = new EUser(WRITER, 'matteo.riva', 'writerMatteo$', 'Matteo', 'Riva', '1989-02-11', 'Italy', 'Parma', 'PR', '43100', 'Viale Piacenza', '23', 'matteo.riva@example.com', '3289988776', "Matteo Riva, scrittore di Parma, creativo e amante della scrittura narrativa.");
        $u5 = new EUser(BASIC, 'francesca.neri', 'fraNeri2024', 'Francesca', 'Neri', '2000-05-05', 'Italy', 'Bologna', 'BO', '40100', 'Via dell\'Indipendenza', '34', 'francesca.neri@example.com', '3295566778', "Francesca Neri, utente base di Bologna, solare e amante dei viaggi culturali.");
        $u6 = new EUser(ADMIN, 'ezio.auditore', 'BestAssassin1', 'Ezio', 'Auditore', '1459-06-24', 'Italy', 'Firenze', 'FI', '50100', 'Viale dei Mille', '8', 'ezio.auditore@example.com', '3214455667', "Bella vita la nostra, eh Fratello? La migliore, possa non cambiare mai e possa non cambiare noi.");
        $u7 = new EUser(WRITER, 'chiara.fontana', 'chiaraW_2024', 'Chiara', 'Fontana', '1994-04-04', 'Italy', 'Ancona', 'AN', '60100', 'Via XXV Aprile', '5', 'chiara.fontana@example.com', '3229988775', "Chiara Fontana, scrittrice di Ancona, appassionata di arte e parole.");
        $u8 = new EUser(BASIC, 'carlo.bruni', 'adminCarlo!', 'Carlo', 'Bruni', '1985-07-17', 'Italy', 'Genova', 'GE', '16100', 'Via XX Settembre', '55', 'carlo.bruni@example.com', '3242233445', "Carlo Bruni, utente base di Genova, pratico, diretto e amante del mare.");
        $u9 = new EUser(BASIC, 'sara.galli', 'saraBasic99', 'Sara', 'Galli', '1996-11-03', 'Italy', 'Verona', 'VR', '37100', 'Piazza Bra', '3', 'sara.galli@example.com', '3267788990', "Sara Galli, utente base di Verona, sempre sorridente e appassionata di teatro.");
        $u10 = new EUser(READER, 'giorgio.conti', 'giorgioRead99', 'Giorgio', 'Conti', '1993-12-21', 'Italy', 'Lecce', 'LE', '73100', 'Via Leuca', '17', 'giorgio.conti@example.com', '3254433221', "Giorgio Conti, lettore di Lecce, appassionato di storia e passeggiate sotto il sole.");

        //PlotCard
        $p1 = new EPlotCard(10000, $u1);
        $u1->addPlotCard($p1);

        $p2 = new EPlotCard(8500, $u2);
        $u2->addPlotCard($p2);

        $p3 = new EPlotCard(9200, $u3);
        $u3->addPlotCard($p3);

        $p4 = new EPlotCard(7600, $u4);
        $u4->addPlotCard($p4);

        $p5 = new EPlotCard(11000, $u5);
        $u5->addPlotCard($p5);

        $p6 = new EPlotCard(1459, $u6);
        $u6->addPlotCard($p6);

        $p7 = new EPlotCard(12500, $u7);
        $u7->addPlotCard($p7);

        $p8 = new EPlotCard(8900, $u8);
        $u8->addPlotCard($p8);

        $p9 = new EPlotCard(10100, $u9);
        $u9->addPlotCard($p9);

        $p10 = new EPlotCard(8800, $u10);
        $u10->addPlotCard($p10);

        //ESubcription

        $sub1 = new ESubscription(WRITER, '1 year', 200.00);
        $sub2 = new ESubscription(WRITER, '1 month', 20.00);
        $sub3 = new ESubscription(WRITER, '1 week', 10.00);
        $sub4 = new ESubscription(READER, '1 year', 100.00);
        $sub5 = new ESubscription(READER, '1 month', 10.00);
        $sub6 = new ESubscription(READER, '1 week', 5.00);

        //ECreditCard

        $cc1 = new ECreditCard('1111 2222 3333 4444', 'Marco', 'Gentile', '2025-12-31', 123);
        $cc2 = new ECreditCard('5555 6666 7777 8888', 'Chiara', 'Marino', '2024-11-30', 123);
        $cc3 = new ECreditCard('9999 0000 1111 2222', 'Stefano', 'De Luca', '2023-10-31', 123);
        $cc4 = new ECreditCard('3333 4444 5555 6666', 'Francesco', 'Romano', '2026-09-30', 122);



        //EPurchase

        $pur1 = new EPurchase('2025-10-01', '2026-10-01', 'Italy', 'Roma', 'RM', '00100', 'Via Appia Nuova, 45', '1', $u7, $sub1, $cc1);
        $pur2 = new EPurchase('2026-01-15', '2026-02-15', 'Italy', 'Torino', 'TO', '10100', 'Via Po, 19', '2', $u4, $sub2, $cc2);
        $pur3 = new EPurchase('2026-06-20', '2026-06-27', 'Italy', 'Genova', 'GE', '16100', 'Via XX Settembre, 55', '3', $u10, $sub6, $cc3);
        $pur4 = new EPurchase('2024-11-05', '2025-11-05', 'Italy', 'Verona', 'VR', '37100', 'Piazza Bra, 3', '4', $u3, $sub4, $cc4);

        //EFollow
        $fo1 = new EFollow($u3, $u4);
        $u4->addFollowing($fo1);
        $u3->addFollower($fo1);
        $fo2 = new EFollow($u10, $u7);
        $u7->addFollowing($fo2);
        $u10->addFollower($fo2);

        //EArticle
        $content = '
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel neque luctus nisl venenatis ullamcorper ac bibendum nibh. Nullam mattis, ante id aliquam vestibulum, diam metus varius augue, ac scelerisque velit justo quis ligula. Pellentesque vulputate tortor quis lorem vulputate facilisis. Donec sagittis sem eu eros luctus sodales. Nulla condimentum, massa a lobortis sagittis, libero sapien finibus nisl, ac vulputate nisl nunc gravida augue. Quisque pretium diam in nibh blandit posuere. Phasellus ullamcorper enim blandit, blandit nulla congue, faucibus ipsum. Duis felis sapien, ornare sit amet vehicula id, mollis ut velit. Vestibulum bibendum fringilla sem, quis interdum arcu maximus semper. Suspendisse eu metus turpis.

            Ut a feugiat libero. Fusce sem nunc, bibendum nec arcu quis, semper fermentum dui. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam vehicula nisi metus, at posuere libero mollis id. Curabitur et dignissim risus. Phasellus vestibulum accumsan tellus, vel vulputate odio varius non. Duis vel tortor vel nulla tristique aliquet. Cras et luctus lacus, ut bibendum libero. Sed bibendum malesuada nulla eu fringilla. Pellentesque tempor dapibus efficitur.

            Fusce gravida at elit sed rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean euismod urna mi, nec efficitur erat sodales eu. Nam a est eu mi placerat sollicitudin. Praesent auctor neque malesuada est semper vehicula. Aenean vitae malesuada odio. Nam non pretium nibh. Nam egestas augue leo. Nulla id mattis orci. Proin mollis, eros nec faucibus commodo, mi risus blandit tortor, quis maximus ante quam id lacus. Vestibulum sit amet enim sed sapien volutpat mattis id eget nibh. Etiam luctus ac leo accumsan mattis. Nullam ultricies, felis quis suscipit sollicitudin, quam enim egestas dolor, sit amet fermentum neque tortor sed nulla. Aenean diam eros, elementum imperdiet tempor sed, dignissim a nibh.

            Mauris finibus ac lacus consectetur egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris nec lorem mattis, sagittis mauris posuere, pulvinar nunc. Aliquam placerat, enim a bibendum ultrices, orci orci aliquet augue, ut sollicitudin massa velit quis nulla. Vestibulum non ligula ac purus pulvinar accumsan. Vivamus vel euismod eros. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam venenatis lorem vel ligula viverra, a finibus lacus sodales. Fusce euismod nulla non orci scelerisque consectetur.

            Suspendisse ultrices massa sit amet ipsum tincidunt, eu malesuada est ultrices. Etiam hendrerit dui sed congue sodales. Vivamus tristique nisl felis, vestibulum vestibulum dui tempus et. Duis sollicitudin laoreet ex vitae eleifend. Curabitur dignissim libero sit amet molestie pellentesque. Quisque pellentesque, enim a vehicula porttitor, massa risus vulputate enim, non ullamcorper justo justo et ipsum. Fusce cursus vestibulum eros, luctus ornare erat mattis ut. Proin commodo venenatis porttitor. Donec nec suscipit dolor, id vehicula dui. Cras blandit vestibulum dolor, eget auctor orci faucibus id. ';

        $testo_biblico = "BIBBIA
        Il Signore è il mio pastore: nulla mi mancherà.
        Egli mi fa riposare in pascoli di verde erba,
        mi guida lungo le acque calme.
        Egli mi ristora l'anima,
        mi conduce per sentieri di giustizia per amore del suo nome.
        Quando anche camminassi nella valle dell'ombra della morte,
        non temerei alcun male, perché tu sei con me;
        il tuo bastone e la tua verga mi danno sicurezza.

        Tu apparecchi davanti a me una mensa in presenza dei miei nemici;
        cospargi di olio il mio capo; la mia coppa trabocca.
        Certo, beni e bontà m'accompagneranno tutti i giorni della mia vita,
        e abiterò nella casa del Signore per lunghi giorni.

        Chi abita al riparo dell'Altissimo riposa all'ombra dell'Onnipotente.
        Io dico al Signore: «Tu sei il mio rifugio e la mia fortezza,
        il mio Dio in cui confido!»
        Egli ti libererà dal laccio dell’uccellatore e dalla peste distruttiva.
        Ti coprirà con le sue penne e sotto le sue ali troverai rifugio;
        la sua fedeltà ti sarà scudo e corazza.

        Tu non temerai il terrore della notte né la freccia che vola di giorno,
        la peste che vaga nelle tenebre, lo sterminio che devasta in pieno mezzogiorno.
        Mille cadranno al tuo fianco e diecimila alla tua destra,
        ma a te non si accosterà.

        Poiché tu hai detto: «Tu, Signore, sei il mio rifugio»,
        e hai fatto dell'Altissimo il tuo riparo,
        nessun male potrà colpirti, né piaga alcuna si accosterà alla tua tenda.
        Egli ordinerà ai suoi angeli di proteggerti in tutte le tue vie.

        Essi ti porteranno sulle mani perché il tuo piede non inciampi in alcuna pietra.
        Tu camminerai sul leone e sull’aspide,
        schiaccerai il leoncello e il serpente.

        «Poiché egli mi ama, io lo salverò;
        lo proteggerò perché conosce il mio nome.
        Quando mi invocherà, io gli risponderò;
        sarò con lui nei momenti difficili,
        lo libererò e lo glorificherò.
        Lo sazierò di lunga vita e gli farò vedere la mia salvezza.»

        Alzo gli occhi verso i monti: da dove mi verrà l’aiuto?
        Il mio aiuto viene dal Signore, che ha fatto il cielo e la terra.
        Egli non permetterà che il tuo piede vacilli,
        colui che ti protegge non sonnecchierà.

        Ecco, colui che protegge Israele non sonnecchia e non dorme.
        Il Signore è colui che ti protegge,
        il Signore è la tua ombra, egli sta alla tua destra.
        Di giorno il sole non ti colpirà, né la luna di notte.
        Il Signore ti proteggerà da ogni male; egli proteggerà la tua vita.
        Il Signore ti proteggerà quando esci e quando entri,
        da ora e per sempre.

        «Io sono la luce del mondo; chi mi segue non camminerà nelle tenebre, ma avrà la luce della vita.» (Giovanni 8:12)

        «Venite a me, voi tutti che siete affaticati e oppressi, e io vi darò riposo.» (Matteo 11:28)

        «Non temere, perché io sono con te; non smarrirti, perché io sono il tuo Dio.» (Isaia 41:10)

        «Il Signore è vicino a quelli che hanno il cuore affranto; egli salva gli spiriti contriti.» (Salmo 34:18)

        «In principio Dio creò il cielo e la terra.» (Genesi 1:1)

        «Siate forti e coraggiosi, non temete e non vi spaventate, perché il Signore, il vostro Dio, è con voi in ogni luogo dove andrete.» (Giosuè 1:9)

        «Il cielo e la terra passeranno, ma le mie parole non passeranno.» (Matteo 24:35)

        «Il Signore è il mio aiuto, non temerò: che cosa potrà farmi l’uomo?» (Ebrei 13:6)

        BIBBIA;";

        $art1 = new EArticle('La Divina Commedia', 'Dante si è perso :(', $content . ' Nel bel mezzo del cazzo' . $content, APPROVED, 'Classico', 'Romazo', '1400-01-01', $u4);
        $u4->addArticle($art1);
        $art2 = new EArticle('Sindaco a quattro zampe: Marcellino rieletto', 'Nel borgo di Miciopoli, il gatto Marcellino ha vinto di nuovo le elezioni locali. Nessun avversario ha avuto il coraggio di sfidarlo. Dicono che le sue fusa risolvano più problemi di mille riunioni.', $content, APPROVED, 'Storico', 'Romanzo', '1958-05-01', $u4);
        $u4->addArticle($art2);
        $art3 = new EArticle('Cuscino smart ti sgrida se vai a dormire tardi', 'Dotato di AI e tono materno, ti sussurra: “Di nuovo su TikTok alle 2 di notte, eh?” Un successo tra le nonne digitali.', $content, APPROVED, 'Fantascienza', 'Romanzo', '1949-06-08', $u4);
        $u4->addArticle($art3);
        $art4 = new EArticle('Errore in videoconferenza diventa promozione', 'Doveva presentare il report trimestrale, ma ha condiviso per sbaglio un karaoke di Beyoncé. La performance è stata talmente grintosa che l’hanno promossa sul posto.', $content, APPROVED, 'Sentimentale', 'Romanzo', '1813-01-28', $u4);
        $u4->addArticle($art4);
        $art5 = new EArticle('Cane regista gira film con GoPro rubata', ' Un labrador curioso ha “preso in prestito” una videocamera e girato scene da Oscar: inseguimenti, abbai e paesaggi da croccantini. Festival in arrivo.', $content, APPROVED, 'Giallo', 'Romanzo', '1980-10-01', $u7);
        $u7->addArticle($art5);
        $art6 = new EArticle('La stampante capisce solo le buone maniere', 'Dopo anni di urla, una scoperta rivoluzionaria: se le parli con gentilezza, la stampante funziona. Confermato: è passivo-aggressiva.', $content, APPROVED, 'Spirituale', 'Romanzo', '1922-01-01', $u7);
        $u7->addArticle($art6);
        $art7 = new EArticle('Parla solo in citazioni di film e nessuno ci fa caso', ' Da “Io sono tuo padre” a “Houston, abbiamo un problema”, Davide comunica solo con frasi da film. In ufficio ormai tutti rispondono “con la stessa moneta”.', $content, APPROVED,  'Horror', 'Romanzo', '1818-03-11', $u7);
        $u7->addArticle($art7);
        $art8 = new EArticle('Pizza empatica si ordina da sola quando sei triste', "Un'app innovativa capta la tua voce depressa e manda subito una margherita d’emergenza. L’unica AI che sa che ti manca l’amore. E il formaggio.", $content, APPROVED, 'Fiabesco', 'Romanzo', '1957-11-25', $u7);
        $u7->addArticle($art8);
        $art9 = new EArticle('La Bibbia: Un Viaggio tra Parole Eterne e Verità senza Tempo', "La Bibbia non è solo un libro antico, ma un cammino spirituale che attraversa i secoli, parlando al cuore di ogni generazione.", $testo_biblico, APPROVED, 'Fiabesco', 'Romanzo', '1957-11-25', $u7);
        $u1->addArticle($art9);


        //EReview

        $rev1 = new EReview(5, 'Davvero interessante, lascia spazio a tante riflessioni.', '2012-12-12', $u7, $art1);
        $art1->addReview($rev1);
        $u7->addReview($rev1);

        $rev2 = new EReview(4, 'Non me lo aspettavo, ma mi ha sorpreso in positivo!', '2020-01-15', $u7, $art2);
        $art2->addReview($rev2);
        $u7->addReview($rev2);

        $rev23 = new EReview(3, 'Un mix ben riuscito tra leggerezza e contenuto. Complimenti!', '2023-01-10', $u3, $art1);
        $art1->addReview($rev23);
        $u3->addReview($rev23);

        $rev41 = new EReview(3, 'Interessante ma complesso', '2023-01-10', $u3, $art1);
        $art1->addReview($rev23);
        $u3->addReview($rev23);


        $rev24 = new EReview(5, 'Capolavoro assoluto', '2023-01-15', $u4, $art2);
        $art2->addReview($rev24);
        $u4->addReview($rev24);

        $rev25 = new EReview(4, 'Molto coinvolgente', '2023-02-01', $u7, $art3);
        $art3->addReview($rev25);
        $u7->addReview($rev25);

        $rev26 = new EReview(2, 'Troppo lento', '2023-02-10', $u10, $art4);
        $art4->addReview($rev26);
        $u10->addReview($rev26);

        $rev27 = new EReview(5, 'Mi ha emozionato', '2023-03-05', $u3, $art5);
        $art5->addReview($rev27);
        $u3->addReview($rev27);

        $rev28 = new EReview(4, 'Ottima lettura', '2023-03-12', $u4, $art6);
        $art6->addReview($rev28);
        $u4->addReview($rev28);

        $rev29 = new EReview(3, 'Niente di speciale', '2023-03-20', $u7, $art7);
        $art7->addReview($rev29);
        $u7->addReview($rev29);

        $rev30 = new EReview(1, 'Noioso', '2023-04-01', $u10, $art8);
        $art8->addReview($rev30);
        $u10->addReview($rev30);

        $rev31 = new EReview(5, 'Storia bellissima', '2023-04-15', $u3, $art2);
        $art2->addReview($rev31);
        $u3->addReview($rev31);

        $rev32 = new EReview(3, 'Scritto bene ma poco originale', '2023-05-01', $u4, $art3);
        $art3->addReview($rev32);
        $u4->addReview($rev32);

        $rev33 = new EReview(4, 'Letto tutto d\'un fiato', '2023-05-10', $u7, $art4);
        $art4->addReview($rev33);
        $u7->addReview($rev33);

        $rev34 = new EReview(2, 'Mi aspettavo di più', '2023-05-20', $u10, $art5);
        $art5->addReview($rev34);
        $u10->addReview($rev34);

        $rev35 = new EReview(5, 'Assolutamente consigliato', '2023-06-01', $u3, $art6);
        $art6->addReview($rev35);
        $u3->addReview($rev35);

        $rev36 = new EReview(4, 'Un grande classico', '2023-06-15', $u4, $art7);
        $art7->addReview($rev36);
        $u4->addReview($rev36);

        $rev37 = new EReview(3, 'Carino, ma non il mio genere', '2023-07-01', $u7, $art8);
        $art8->addReview($rev37);
        $u7->addReview($rev37);

        $rev38 = new EReview(1, 'Lento e difficile da seguire', '2023-07-10', $u10, $art1);
        $art1->addReview($rev38);
        $u10->addReview($rev38);

        $rev39 = new EReview(4, 'Trama avvincente', '2023-08-01', $u3, $art3);
        $art3->addReview($rev39);
        $u3->addReview($rev39);

        $rev40 = new EReview(5, 'Meraviglioso', '2023-08-15', $u4, $art5);
        $art5->addReview($rev40);
        $u4->addReview($rev40);

        $rev41 = new EReview(5, 'Riflessivo. Pregherò più spesso', '2023-08-15', $u4, $art5);
        $art9->addReview($rev41);
        $u4->addReview($rev41);

        $rev42 = new EReview(5, 'La fede che ci guida', '2023-08-15', $u4, $art5);
        $art9->addReview($rev42);
        $u4->addReview($rev42);


        //EReading

        $read1 = new EReading($u1, $art1);
        $u1->addReading($read1);
        $art1->addReading($read1);

        $read2 = new EReading($u2, $art3);
        $u2->addReading($read2);
        $art3->addReading($read2);

        $read3 = new EReading($u3, $art2);
        $u3->addReading($read3);
        $art2->addReading($read3);

        $read4 = new EReading($u4, $art4);
        $u4->addReading($read4);
        $art4->addReading($read4);

        $read5 = new EReading($u5, $art5);
        $u5->addReading($read5);
        $art5->addReading($read5);

        $read6 = new EReading($u6, $art6);
        $u6->addReading($read6);
        $art6->addReading($read6);

        $read7 = new EReading($u7, $art1);
        $u7->addReading($read7);
        $art1->addReading($read7);

        $read8 = new EReading($u8, $art7);
        $u8->addReading($read8);
        $art7->addReading($read8);

        $read9 = new EReading($u9, $art8);
        $u9->addReading($read9);
        $art8->addReading($read9);

        $read10 = new EReading($u10, $art2);
        $u10->addReading($read10);
        $art2->addReading($read10);

        $read11 = new EReading($u3, $art6);
        $u3->addReading($read11);
        $art6->addReading($read11);

        //Popolazione db

        // utenti
        FPersistentManager::getInstance()->saveInDb($u1);
        FPersistentManager::getInstance()->saveInDb($u2);
        FPersistentManager::getInstance()->saveInDb($u3);
        FPersistentManager::getInstance()->saveInDb($u4);
        FPersistentManager::getInstance()->saveInDb($u5);
        FPersistentManager::getInstance()->saveInDb($u6);
        FPersistentManager::getInstance()->saveInDb($u7);
        FPersistentManager::getInstance()->saveInDb($u8);
        FPersistentManager::getInstance()->saveInDb($u9);
        FPersistentManager::getInstance()->saveInDb($u10);
        // plot cards
        FPersistentManager::getInstance()->saveInDb($p1);
        FPersistentManager::getInstance()->saveInDb($p2);
        FPersistentManager::getInstance()->saveInDb($p3);
        FPersistentManager::getInstance()->saveInDb($p4);
        FPersistentManager::getInstance()->saveInDb($p5);
        FPersistentManager::getInstance()->saveInDb($p6);
        FPersistentManager::getInstance()->saveInDb($p7);
        FPersistentManager::getInstance()->saveInDb($p8);
        FPersistentManager::getInstance()->saveInDb($p9);
        FPersistentManager::getInstance()->saveInDb($p10);
        // subscriptions
        FPersistentManager::getInstance()->saveInDb($sub1);
        FPersistentManager::getInstance()->saveInDb($sub2);
        FPersistentManager::getInstance()->saveInDb($sub3);
        FPersistentManager::getInstance()->saveInDb($sub4);
        FPersistentManager::getInstance()->saveInDb($sub5);
        FPersistentManager::getInstance()->saveInDb($sub6);
        //credit cards
        FPersistentManager::getInstance()->saveInDb($cc1);
        FPersistentManager::getInstance()->saveInDb($cc2);
        FPersistentManager::getInstance()->saveInDb($cc3);
        FPersistentManager::getInstance()->saveInDb($cc4);
        // purchases
        FPersistentManager::getInstance()->saveInDb($pur1);
        FPersistentManager::getInstance()->saveInDb($pur2);
        FPersistentManager::getInstance()->saveInDb($pur3);
        FPersistentManager::getInstance()->saveInDb($pur4);
        // follows
        FPersistentManager::getInstance()->saveInDb($fo1);
        FPersistentManager::getInstance()->saveInDb($fo2);
        // articles
        FPersistentManager::getInstance()->saveInDb($art1);
        FPersistentManager::getInstance()->saveInDb($art2);
        FPersistentManager::getInstance()->saveInDb($art3);
        FPersistentManager::getInstance()->saveInDb($art4);
        FPersistentManager::getInstance()->saveInDb($art5);
        FPersistentManager::getInstance()->saveInDb($art6);
        FPersistentManager::getInstance()->saveInDb($art7);
        FPersistentManager::getInstance()->saveInDb($art8);
        // reviews
        FPersistentManager::getInstance()->saveInDb($rev1);
        FPersistentManager::getInstance()->saveInDb($rev2);
        FPersistentManager::getInstance()->saveInDb($rev23);
        FPersistentManager::getInstance()->saveInDb($rev24);
        FPersistentManager::getInstance()->saveInDb($rev25);
        FPersistentManager::getInstance()->saveInDb($rev26);
        FPersistentManager::getInstance()->saveInDb($rev27);
        FPersistentManager::getInstance()->saveInDb($rev28);
        FPersistentManager::getInstance()->saveInDb($rev29);
        FPersistentManager::getInstance()->saveInDb($rev30);
        FPersistentManager::getInstance()->saveInDb($rev31);
        FPersistentManager::getInstance()->saveInDb($rev32);
        FPersistentManager::getInstance()->saveInDb($rev33);
        FPersistentManager::getInstance()->saveInDb($rev34);
        FPersistentManager::getInstance()->saveInDb($rev35);
        FPersistentManager::getInstance()->saveInDb($rev36);
        FPersistentManager::getInstance()->saveInDb($rev37);
        FPersistentManager::getInstance()->saveInDb($rev38);
        FPersistentManager::getInstance()->saveInDb($rev39);
        FPersistentManager::getInstance()->saveInDb($rev40);
        // readings
        FPersistentManager::getInstance()->saveInDb($read1);
        FPersistentManager::getInstance()->saveInDb($read2);
        FPersistentManager::getInstance()->saveInDb($read3);
        FPersistentManager::getInstance()->saveInDb($read4);
        FPersistentManager::getInstance()->saveInDb($read5);
        FPersistentManager::getInstance()->saveInDb($read6);
        FPersistentManager::getInstance()->saveInDb($read7);
        FPersistentManager::getInstance()->saveInDb($read8);
        FPersistentManager::getInstance()->saveInDb($read9);
        FPersistentManager::getInstance()->saveInDb($read10);
        FPersistentManager::getInstance()->saveInDb($read11);
    }
}
