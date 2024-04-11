# Examens-arbete

 ## Anpassad WordPress-bloggutveckling

 ### Kort beskrivning:


The Imagined Blog Platform syftar till att ge användarna en heltäckande bloggupplevelse, så att de kan skapa, redigera och dela innehåll. Detta dokument beskriver de funktionella och icke-funktionella krav som är nödvändiga för utveckling och driftsättning av plattformen.

2. Funktionskrav

2.1. Användarhantering

● Applikationen ska tillhandahålla registrerings-, inloggnings- och utloggningsfunktioner för användare.

● Användare ska kunna redigera sina inloggningsuppgifter.

● Användarroller ska inkludera admin och användare.

2.2. Blogghantering

● Användare måste kunna skapa, redigera och ta bort blogginlägg.

● Blogginlägg bör stödja taggningsfunktioner.

● Användare ska kunna ladda upp bilder till sina blogginlägg.

● Administratörer ska ha möjlighet att redigera användarroller och hantera taggar för blogginlägg.

● Besökare utan inloggningsuppgifter kan läsa offentliga blogginlägg.

2.3. Interaktionsfunktioner

● Användare ska kunna gilla andra användares blogginlägg.

● Användare måste kunna kommentera andra användares blogginlägg.

2.4. Administrativa funktioner

● Administratörer ska kunna ta bort användare.

● Administratörer kan skapa och redigera taggar för blogginlägg.

2.5. Sessionshantering

● Applikationen ska hantera användarsessioner säkert.

2.6. Cross-Platform-kompatibilitet

● Plattformen måste vara synlig på både mobila och stationära skärmar.

2.7. Datalagring

● Data ska lagras i en relationsdatabas.

● Tabeller relaterade till varandra ska inkludera användare, blogg och kommentarer.

3. Icke-funktionella krav

3.1. Tillgänglighet

● Plattformen ska följa tillgänglighetsstandarder för att säkerställa inkludering.

3.2. säkerhet

● Mekanismer för autentisering och auktorisering av användare ska implementeras på ett säkert sätt.

● Datakrypteringstekniker ska användas för att skydda känslig information.

3.3. Prestanda

● Applikationen ska vara optimerad för effektiv prestanda, med minimala svarstider.

3.4. Skalbarhet

● Plattformen bör utformas för att tillgodose potentiell framtida tillväxt i användarbas och innehåll.

3.5. Installation och distribution

● Användare kan installera temat direkt från WordPress-temaförrådet eller genom att ladda upp tema-zip-filen via WordPress-instrumentpanelen.

● Installationsguiden guidar användare genom att konfigurera viktiga inställningar som databasuppgifter, webbplatstitel och administratörsuppgifter.

Automatiska uppdateringar kommer att stödjas för att säkerställa att användare har tillgång till de senaste funktionerna och säkerhetskorrigeringarna.

● Kompatibilitetskontroller kommer att utföras under installationen för att säkerställa smidig drift med befintliga WordPress-plugins och funktioner.

4. Ytterligare funktioner

Valfria funktioner som att hantera cookies, visa onlineanvändare och avpublicera blogginlägg kan övervägas för framtida utvecklingsupprepningar.
