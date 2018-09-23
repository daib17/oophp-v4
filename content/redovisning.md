---
---
Redovisning
=========================


Kmom01
-------------------------

**Hur känns det att hoppa rakt in i objekt och klasser med PHP, gick det bra och kan du relatera till andra objektorienterade språk?**

Jag har tidigare erfarenhet i OOP i andra språk som Java och C++, så det känns bara naturligt att använda objektorienterad programmering i PHP. Det kommer att vara intressant att jämföra PHPs implementering av  OOP med andra språk som är mer objektorienterade från början som till exempel Python.

**Berätta hur det gick det att utföra uppgiften “Gissa numret” med GET, POST och SESSION?**

Det gick bra med hjälp av Mikaels videosom visar den första delen av uppgiften med GET klienten. Jag följde samma struktur och delade PHP kod som hanterar logik från HTML kod för vyerna i olika filer och mappar. Det hjälpte också att vi hade jobbat lite med GET, POST och SESSION i tidigare kurser. I delen av uppgiften där vi jobbar med SESSION för att minnas spelets ställning, valde jag att spara hela objektet med användning av funktionerna serialize och deserialize.

**Har du några inledande reflektioner kring me-sidan och dess struktur?**

Anax är inte helt nytt eftersom vi hade jobbat med ramverket tidigare i designkursen. Mikaels videos ger en bra överblick av ramverket i videoserien på youtube, men jag kan inte säga att jag har full koll på det än. Det kommer säkert att fixa sig i det kommande kurserna.  

**Vilken är din TIL för detta kmom?**

Min TIL för detta kmom måste vara att börja med OOP i PHP. Att skapa min första class i PHP och spara ett objekt i en session med hjälp av serialize/deserialize funktionerna.


Kmom02
-------------------------

**Hur gick det att överföra spelet “Gissa mitt nummer” in i din me-sida?**

Det gick bra till slut men jag skulle inte ha kunnat genomföra uppgiften utan hjälp av videoserien. Det är så mycket i anax som jag inte har koll på att jag får panik varje gång jag får ett felmeddelande. Det finns också små variationer mellan den uppdaterade versionen av anax och den som användes när videon filmades, vilket gör det lite mer komplicerat.

**Berätta om din syn på modellering likt UML jämfört med verktyg som phpDocumentor. Fördelar, nackdelar, användningsområde? Vad tycker du om konceptet make doc?**

Båda UML och phpDocumentor hjälper till att generera information om kodens struktur (klasser, attributer, metoder, m.m.) och funktionalitet. De gör det på olika sätt, UML i form av visuella diagram och phpDocumentor på ett mer vanligt sätt genom att använda kommentarer i koden för att skapa ett långt dokument som beskriver kodens interface.

phpDocumentor är ett lätt verktyg att använda. Det behövs bara bra kommentarer för att automatiskt skapa användbar dokumentation. UML är mycket mer. Det kan också användas för att generera information som kan hjälpa till att förstå koden, men det är inte ett verktyg som phpDocumentor utan ett modelleringsspråk som kan hjälpa i planeringen av ett projekt innan man börjar koda.

När det gäller make doc tycker jag att det är mycket praktiskt att kunna köra ett kommando som direkt generarar dokumentation på ett automatiskt sätt.

**Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?**

Det är absolut mycket lättare för mig att skriva kod utanför ramverket, speciellt nu när jag inte har full koll på anax struktur och kod, men jag kan redan se nackdelar med att använda ett ramverket som delar koden i router, klasser och vyer.

**Vilken är din TIL för detta kmom?**

Min TIL för detta kmom är att se hur PHP implementerar arv och hur man använder konstanter inom en klass med self.


Kmom03
-------------------------

**Har du tidigare erfarenheter av att skriva kod som testar annan kod?**

Jag har tidigare använt JUnit i Java/Android i några projekt men alltid på en basic nivå.   

**Hur ser du på begreppen enhetstestning och att skriva testbar kod?**

Jag känner alltid först lite motstånd att börja skriva testkod, men jag förstår att det är en viktig del av utvecklingen av mjukvara och det kan spara mycket tid och undvika problem på lång sikt.

**Förklara kort begreppen white/grey/black box testing samt positiva och negativa tester, med dina egna ord.**

White box testning refererar till en testmetod där man har full inblick i koden som testas. Black box testning är precis motsatsen, testaren har inte tillgång till source koden som man testar. Här brukar man testa om den output man får är korrekt från den input som givits. Grey box testning är en kombination av white och black-metoderna. Testaren har bara tillgång till visa delar av koden.     

I positiva tester ger man korrekt input och man kollar om output matchar den som förväntas. Negativa tester refererar till en metod där man matar in fel data och kollar om systemet hanterar felaktig data som det borde göra, till exempel genom att kasta en exception eller felmeddelande.

**Berätta om hur du löste uppgiften med Tärningsspelet 100, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?**

Jag har fyra klasser, Dice, DiceHand, Round och Game. Dice och DiceHand är ungefär samma som i förra veckan. Klassen Round hanterar varje spelares runda. Klassen innehåller en array av DiceHand objekt som instance variabel och metoder för att kasta tärningar, får alla värden för alla tärningar i kastet, deras summa, värdet för alla händer inom en runda, antal händer och sista kastet.
Game klassen hanterar spellogiken. Jag försökte flytta så mycket kod som möjligt från routern till Game klassen. Instancevariabel $roundArr innehåller en tvådimensionell array av Round objekt. Genom att använda en array kan man lätt uppgradera koden för att hantera fler spelare. Variabeln $turn indikerar vilken spelares tur det är (0 för player och 1 för cpu i den här versionen). Två metoder som är speciellt viktiga i klassen är changeTurn() och cpuPlays(). Metoden changeTurn byter tur mellan spelarna och skapar ett nytt Round objekt för spelaren och lägger det till arrayen. Metoden cpuPlays kör en enkel algoritm så cpu kan välja mellan att forsätta spela eller stanna.

**Hur väl lyckades du testa tärningsspelet 100?**

Jag fick 100% code coverage, så alla klasser och metoder är testade. Det betyder förstås inte att alla tester är välskrivna.

**Vilken är din TIL för detta kmom?**

PHPUnit är helt nytt för mig och jag tycker att informationen som code coverage analysis genererar med detaljerad kodtäckning rad för rad är speciellt användbar.



Kmom04
-------------------------

Här är redovisningstexten



Kmom05
-------------------------

Här är redovisningstexten



Kmom06
-------------------------

Här är redovisningstexten



Kmom07-10
-------------------------

Här är redovisningstexten
