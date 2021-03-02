-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2021 at 12:43 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `idAnkete` int(255) NOT NULL,
  `pitanje` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktivna` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`idAnkete`, `pitanje`, `aktivna`) VALUES
(1, 'What do you prefere?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `idKategorije` int(255) NOT NULL,
  `naziv` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `slikasrc` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`idKategorije`, `naziv`, `slikasrc`) VALUES
(1, 'Dinner', 'dinner.jpg'),
(2, 'Desserts', 'desserts.jpg'),
(3, 'Healthy', 'healthy.jpg'),
(4, 'Salads', 'salads.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `idKomentar` int(255) NOT NULL,
  `tekst` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `idKorisnika` int(255) NOT NULL,
  `idPosta` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`idKomentar`, `tekst`, `datum`, `idKorisnika`, `idPosta`) VALUES
(1, 'It looks very yummy.I’ll be making this recipe this weekend and I am so excited! Thanks for sharing such a delicious recipe with us. I can’t wait to catch up with all your ‘Recipe’!!', '2021-02-01 13:12:11', 2, 8),
(2, 'Tried this recipe last night. A lot of people wish cooking was this easy I love to cook but sometimes I wish I just need 5 or less ingredients. This is so simple and quick and a great meal.', '2021-02-04 17:38:15', 2, 8),
(3, 'I made pie before and it didn\'t turn out great… So i\'m definitely adding this to my list.', '2021-02-04 18:54:45', 2, 7),
(4, 'Oh, your recipe made me feel so cozy! Thank you for sharing. Wanna make it for my family, so wait for feedback.', '2021-02-04 19:11:49', 3, 10),
(5, 'Made this tonight – so easy and delicious!. We do meatless Mondays and this will definitely be going in the rotation! Thanks for posting!', '2021-02-04 19:11:49', 3, 3),
(6, 'DE-LISH-OUS! Made it last night and we’ve been cutting out little slivers about every couple hours… Too good!', '2021-02-04 19:14:20', 3, 7),
(7, 'So good! Love the balance of flavors. We doubled the recipe for lunch wraps today.', '2021-02-05 17:34:08', 2, 5),
(8, 'I can’t wait to try these pie crust recipe!! They look absolutely delicious and I will making these first hung in the morning!\n\n', '2021-02-05 17:40:35', 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `idKorisnika` int(255) NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aktivan` tinyint(1) NOT NULL,
  `aktivacioniKod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUloge` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`idKorisnika`, `ime`, `prezime`, `email`, `pass`, `aktivan`, `aktivacioniKod`, `datum`, `idUloge`) VALUES
(1, 'Milica', 'Jovanovic', 'milica@gmail.com', '504938a121efec5f4fbdbcc64ca5736e', 1, '//', '2021-02-03 19:23:58', 1),
(2, 'Anja', 'Radonjic', 'anja@gmail.com', 'e77aa307d1724c045d189fca4e01fe75', 1, '//', '2021-02-03 19:39:36', 2),
(3, 'Nemanja', 'Maksimovic', 'nemanja@gmail.com', '35971964ae23a1be1e269c68f365abe7', 1, '//', '2021-02-04 19:10:09', 2),
(4, 'Dejan', 'Trivunovic', 'dejan@gmail.com', '1df14c3c92d8b2c66a6428a404cb0d96', 1, '//', '2021-02-05 12:12:24', 2),
(5, 'Dijana', 'Radovanovic', 'dijana@gmail.com', '79dafc7a100a74fc9dcbdad6c346060c', 1, 'b627422c75989ed32fe7170fb7dea3df', '2021-02-05 12:13:56', 2),
(6, 'Tijana', 'Nestinac', 'tijana@gmail.com', 'fdf62033af972719ad19b4f32d06eaff', 1, '4b5ab1ff32dd3086a754fafafe079cd0', '2021-02-05 12:15:40', 2),
(7, 'Filip', 'Petrovic', 'filip@gmail.com', 'a8222b7d267fa9ecc019b9e90f3c2a22', 1, 'a7690168a1c0d177289b53cc0ad3706a', '2021-02-05 12:17:10', 2),
(8, 'Nikola', 'Brzovan', 'nikola@gmail.com', 'a646e457db47ad218d6d9d3ce325878b', 1, '6a1334e1bc532e2c86fb242124cb6d2a', '2021-02-05 12:18:00', 2),
(9, 'Dunja', 'Katic', 'dunja@gmail.com', '355006f2b5d99308ed8e6e973d4ac596', 1, 'dfe9c498db570f38b91a38b3123a1d5e', '2021-02-05 12:43:22', 2),
(11, 'Kristina', 'Mladenovic', 'kristina@gmail.com', '6e812aa02d646ff9faff83884949c999', 1, '8d9689c9b264c7802f0fcb317b45b255', '2021-02-11 11:36:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `idMeni` int(255) NOT NULL,
  `naziv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `putanja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prikaz` int(1) NOT NULL,
  `prioritet` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`idMeni`, `naziv`, `putanja`, `prikaz`, `prioritet`) VALUES
(1, 'Home', 'index.php', 1, 1),
(2, 'Recipes', 'recipes.php', 1, 5),
(3, 'Log in / Register', 'logreg.php', 0, 15),
(4, 'Send recipe', 'send.php', 4, 10),
(5, 'Admin panel', 'admin.php', 3, 20),
(6, 'Log out', 'logout.php', 2, 25),
(7, 'Contact', 'contact.php', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `ocena`
--

CREATE TABLE `ocena` (
  `idOcena` int(255) NOT NULL,
  `idPosta` int(255) NOT NULL,
  `idKorisnika` int(255) NOT NULL,
  `ocena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ocena`
--

INSERT INTO `ocena` (`idOcena`, `idPosta`, `idKorisnika`, `ocena`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 5),
(3, 2, 2, 4),
(5, 9, 2, 5),
(6, 3, 2, 4),
(7, 5, 2, 5),
(8, 5, 1, 4),
(9, 3, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `odgovori`
--

CREATE TABLE `odgovori` (
  `idOdgovora` int(255) NOT NULL,
  `tekstOdgovora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idAnkete` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `odgovori`
--

INSERT INTO `odgovori` (`idOdgovora`, `tekstOdgovora`, `idAnkete`) VALUES
(1, 'Cooking with the family', 1),
(2, 'Cooking alone', 1),
(3, 'Both', 1);

-- --------------------------------------------------------

--
-- Table structure for table `odgovorianketa`
--

CREATE TABLE `odgovorianketa` (
  `idOdgovorAnketa` int(255) NOT NULL,
  `idOdgovora` int(255) NOT NULL,
  `idAnkete` int(255) NOT NULL,
  `idKorisnika` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `odgovorianketa`
--

INSERT INTO `odgovorianketa` (`idOdgovorAnketa`, `idOdgovora`, `idAnkete`, `idKorisnika`) VALUES
(1, 1, 1, 2),
(4, 2, 1, 3),
(5, 3, 1, 5),
(6, 1, 1, 8),
(7, 2, 1, 7),
(8, 2, 1, 9),
(9, 1, 1, 6),
(10, 2, 1, 1),
(12, 3, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `poruke`
--

CREATE TABLE `poruke` (
  `idPoruke` int(255) NOT NULL,
  `naslov` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tekst` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poruke`
--

INSERT INTO `poruke` (`idPoruke`, `naslov`, `tekst`, `email`, `datum`) VALUES
(2, 'Naslov 2', 'Tekst tekst  tekst tekst tekst tekst tekst tekst tekst  tekst tekst tekst tekst tekst tekst tekst  tekst tekst tekst tekst tekst tekst tekst  tekst tekst tekst tekst tekst tekst tekst ', 'neca@gmail.com', '2021-02-09 07:43:06'),
(3, 'Naslov 3', 'Tekst tekst  tekst tekst tekst tekst tekst tekst tekst  tekst tekst tekst tekst tekst tekst tekst  tekst tekst tekst tekst tekst tekst tekst  tekst tekst tekst tekst tekst tekst tekst ', 'nidza@gmail.com', '2021-02-09 07:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `posaljirecept`
--

CREATE TABLE `posaljirecept` (
  `idRecept` int(255) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tekst` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posaljirecept`
--

INSERT INTO `posaljirecept` (`idRecept`, `title`, `tekst`) VALUES
(1, 'Naslov 1', 'Array'),
(2, 'Naslov 1', 'Tekst tekst tekst  tekst tekst  tekst tekst  tekst tekst'),
(3, 'Naslov 1', 'Tekst tekst tekst  tekst tekst  tekst tekst');

-- --------------------------------------------------------

--
-- Table structure for table `postovi`
--

CREATE TABLE `postovi` (
  `idPosta` int(255) NOT NULL,
  `naslov` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tekst` text COLLATE utf8_unicode_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `idKategorije` int(255) NOT NULL,
  `slikasrc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pocetniTekst` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `postovi`
--

INSERT INTO `postovi` (`idPosta`, `naslov`, `tekst`, `datum`, `idKategorije`, `slikasrc`, `pocetniTekst`) VALUES
(1, 'Lemon Cupcakes', 'Preheat oven to 375 degrees F (190 degrees C). Line 30 cupcake pan cups with paper liners.\r\nSift the self-rising flour and salt together in a bowl. In another bowl, beat the unsalted butter and sugar with an electric mixer until light and fluffy. Beat in the eggs one at a time, beating each egg until incorporated before adding the next. Mix in the vanilla extract and lemon zest.\r\nGently beat the flour mixture into the butter mixture, one third at a time, alternating with half the milk and half the lemon juice after each of the first 2 additions of flour. Beat until just combined; do not over mix.\r\nFill the prepared cupcake liners with batter 3/4 full, and bake in the preheated oven until a toothpick inserted in the center comes out clean, about 17 minutes. Let the cupcakes cool in the pans for about 10 minutes before removing them to finish cooling on a rack.\r\nTo make the icing, beat the cream in a chilled bowl with an electric mixer set on Low until the cream begins to thicken. Add the confectioners\' sugar and lemon juice, a little at a time, beating after each addition, until fully incorporated. Increase the mixer speed to High, and beat until the icing forms soft peaks, about 5 minutes. Spread on the cooled cupcakes. Refrigerate leftovers.\r\n\r\n', '2021-02-03 16:40:05', 2, 'cupcake.jpeg', 'When life gives you lemons, make a big batch of lemon cupcakes!! These are one of my favorite cupcake recipes, I love the fluffy, moist crumb with that lemony frosting. Each bite is perfect. I loved these simple buttercream lemons as a decoration idea. They’re delicious any way you make them but if you feel like breaking those piping tips out then I highly recommend giving this a try!'),
(2, 'Cucumber Salad', 'Add water and vinegar to a medium pot. Add sugar. Place pot on medium high heat and stir until sugar is dissolved, then remove from heat. Halve and thinly slice one small red onion. Place onion sliced in the vinegar solution, mix and set aside. Remove some skin from the cucumbers. This is optional but I like the added visual interest of the striped side. Thinly slice the English cucumbers. Place cucumbers in a large bowl, sprinkle with salt and toss then cover and chill for 30-40 minutes.\r\nDrain excess juice from cucumbers. Chop the fresh dill and mint. Pour dressing and onions on cucumbers. Sprinkle with dill and mint. Toss and serve.', '2021-02-03 16:47:17', 4, 'cucumber.jpeg', 'When the weather warms up it’s time to get serious about barbecue, picnics, and fun gatherings filled with food. All of this means lots of side dishes that are low on prep time but big on flavor. This cucumber salad recipe is full of fresh flavor, lots of crunch and a won’t leave you feeling weighed down after a big portion.'),
(3, 'Spinach Artichoke Pasta', 'Melt the butter in a saucepan and add the flour. Stir them together to create a roux. Next, add the cream. Then add the stock and stir the sauce until thickened slightly. Add the paprika, balsamic vinegar and salt and pepper to the sauce. Stir together then set aside (see the ideal thickness of the sauce in photo 6 above). Add more butter to a pan or skillet and saute the chopped onion. Add the mushrooms, garlic, and thyme. Saute for a few minutes. Next, add the spinach and stir until wilted.Saute for a few minutes. After the spinach is wilted add the artichokes and turn off the heat. Add the sauce and cheeses. Stir everything together until well combined and the cheese has melted. Add cooked pasta and toss to combine.\r\n ', '2021-02-03 21:03:54', 1, 'pasta.jpg', 'Creamy and comforting Spinach Artichoke Pasta made with a super easy cheese sauce, mushrooms and spinach. This pasta is crazy delicious and so simple to whip up, perfect for any day of the week!'),
(4, 'Greek Salad', 'Add olive oil, salt, pepper, and crushed oregano and thyme leaves into a jar. Add vinegar, lemon zest and juice and honey mustard. Shake well and set aside. Halve and slice an English cucumber. Thinly slice about 1/2 cup of red onion. Chop those Kalamata olives in half. Either halve cherry tomatoes or cut larger tomatoes into wedges. De-seed and cut a bell pepper into squares. Add cucumbers, tomatoes, olives, onion and pepper into a large bowl. Crumble feta liberally over salad. Pour dressing just before serving, toss and enjoy. You can garnish with more oregano if desired.', '2021-02-03 21:10:46', 4, 'greeksalad.jpg', 'This quick, easy, and DELICIOUS Greek salad is chock full of cucumber, tomatoes, feta, and Kalamata olives all brought together with a tangy lemon herb vinaigrette that you\'re guaranteed to love! You can make it way in advance and dress before serving for a great anytime meal.'),
(5, 'Chicken Alfredo', 'In a large skillet, heat olive oil over medium heat. Add garlic; cook, stirring occasionally, until toasted, about 2 minutes. Add spinach, salt, pepper, and chile flakes; cook, stirring often, until wilted, 2 to 3 minutes.  Add fontina and cream cheese. Stir the cheese mixture into the spinach until smooth and creamy. Reduce heat to low; add cooked pasta, stirring to gently to combine, and adding a splash of pasta water a little at a time to emulsify sauce, if needed. Remove from heat; stir in Greek yogurt. Top servings with sliced grilled chicken.', '2021-02-03 21:13:43', 1, 'chicken.jpg', 'Creamy and comforting homemade Chicken Alfredo without the heavy cream, I\'ve created a lighter version of your favorite classic dish and it\'s just as delicious. Made with garlicky spinach for an extra flavor punch, tossed with fettuccini pasta and topped with grilled chicken.'),
(6, 'Avocado Salad', 'For the salad; start off by cutting the peels off of the blood oranges and grapefruit.\r\nOnce you have your peeled blood oranges and grapefruits, cut them into thin slices.\r\nCut the avocado in half, remove the seed and the skin, then cut it into slices. You’ll also want to cut the burrata into thin slices as well. For the dressing; in a small mason jar or bowl, pour in 1/4 cup of olive oil. Add 1/4 cup of vinegar. I used blackberry vinegar, but you can use a white vinegar or another kind of your choice. Cut the orange in half and squeeze in about 3 tablespoons (hold the seeds!). Add the salt and pepper, put the lid on and give it a good shake. Combine all of the ingredients into a bowl and give it a toss with the dressing. Enjoy!', '2021-02-03 21:17:05', 4, 'avocado.jpeg', 'This delicious avocado salad features lots of citrus, avocado, creamy burrata, tomatoes, chickpeas, and a light zingy dressing. It comes together in a snap and pairs wonderfully with nearly everything!'),
(7, 'Peanut Butter Pie', 'To make the pie crust combine the flour and salt in a food processor and pulse briefly to mix (you can also do this by hand with two forks). Scatter the butter over the top and pulse just until the mixture forms coarse crumbs about the size of peas. Mix the ice water and vodka in a small bowl then drizzle into the flour mixture while pulsing just until the dough starts to come together.\r\nTransfer the dough onto a pastry mat or another floured surface and knead 2 to 3 times just to help it come together a bit. Gently flatten the dough into a one-inch thick disk and cover it in plastic wrap or a ziplock bag, then place it in the fridge to chill for about 30 minutes to an hour. Preheat an oven to 425°F. Line a baking sheet with parchment paper. With a rolling pin, on a well-floured surface, flatten out into a circle at least 1 inch larger than the pie pan, rolling from the center to the edge, turning and flouring the dough so it doesn’t stick to the board.  Fold the dough in half and ease it into the pie pan without stretching at all and unfold to fit the pan. With a small sharp paring knife, cut the dough 1 inch larger around than the pan. Fold the edge under and crimp the edge with either your fingers or the tines of a fork. Dock your pie crust. Add tin foil to keep your pie crust propped up. Bake at 425 degrees for 15 minutes. Make the egg wash by mixing the egg and a dash of heavy cream together. Take out the tin foil and brush the crust with the egg wash. Now dock the pie crust with a fork or sharp knife and add a tent of foil around the sides. Bake for 15 minutes at 425 then reduce temperature to 375 degrees and bake until the center is golden. Once the center is golden, remove the pie crust from the oven and set aside To make the filling add the peanut butter and cream cheese to a stand mixer fitted with a paddle attachment and beat together until smooth. Add powdered sugar and beat until combined. In a separate bowl whip the cream until soft peaks form then fold into peanut butter mixture.\r\nSpoon or pipe filling into the cooled pastry crust. Smooth and chill for at least three hours. Whip the cold cream with 1/4 cup of confectioner’s sugar and the vanilla extract. Add the whipped cream to the chilled pie. Arrange it into a mount that almost reaches the crust. Drizzle melted chocolate onto the pie. Toss roasted peanuts in the some of the melted chocolate and sprinkle on top.', '2021-02-03 21:19:41', 2, 'pie.jpg', 'This decadent and DELICIOUS peanut butter pie has a crisp homemade butter crust, creamy peanut butter filling, lots of whipped cream drizzled with melted chocolate, and it\'s all crowned with a sprinkling of chocolate-covered roasted peanuts. Eat bite is pure bliss!'),
(8, 'Raspberry Beet Salad', 'In a double boiler, steam the beets at a rolling boil for about 30 minutes or until they become tender. When done, transfer to cold water and peel off the skin. Slice and add to the salad.\r\nSlice the tomatoes. Chop up the lemon thyme. Arrange all of the salad ingredients in a bowl with the mixed greens. In a mason jar, add vinegar. \r\nToss in the chopped lemon thyme.  Add salt. \r\nAdd raspberries. Slice an avocado. Pour in olive oil. Shake the dressing. Toss the salad a desired amount of dressing.', '2021-02-03 21:34:36', 3, 'raspberry.jpg', 'A super-fast salad that\'s sure to please. I couldn\'t help myself from adding thin sliced of steamed candy beets but they\'re totally optional. Taste-wise the star of this dish are the sweet and tangy raspberries and cherry tomatoes. The dressing is also sure to become one of your favorites. I actually hate store-bought raspberry vinaigrettes but this home made one is beyond delicious; raspberries, champagne vinegar, fresh lemon thyme, a dash of salt and honey, and olive oil of course make for a delicious dressing.'),
(9, 'Pie Crust Recipe', 'Add the flour, salt, and sugar to a large bowl and whisk together to combine. See below for steps to make pie dough if using a food processor. Cube the cold butter and toss with the flour. Use your clean hands to break the butter into smaller pieces. You want a range of pieces from small lentil-sized pieces to larger clumps the size of almonds. Drizzle in three tablespoons of ice water and then mix with a fork. The dough should become more “shaggy” and less crumbly. Now you can either add 2 more tablespoons of ice water or sprinkle in two tablespoons of lemon juice or vinegar and/or vodka. Acid in the lemon juice and vinegar will inhibit gluten development.  Vodka will help bring the dough together without activating the gluten and the alcohol does bake off. If your crust is a bit crumbly still you can sprinkle in an extra tablespoon of liquid. Gently knead it together until the dough clumps together. I like doing this in the bowl since there’s less cleanup and it’s all contained. Shape it into a disk and wrap tightly in plastic wrap. Chill for 1 hour or up to 3 days. Don’t worry if the dough seems a bit dry. It comes together as it chills. Once your pie crust is chilled, remove it from the fridge and let it warm up on the counter for a few minutes. Roll it out to about 1/4 of an inch, then transfer it to a pie pan or baking sheet if you’re making a galette. The bake time will depend on the form and filling. ', '2021-02-03 21:38:47', 2, 'pie.jpeg', 'Making a perfect buttery flaky pie crust is easier than you can imagine and the perfect pie dough recipe is the foundation for every amazing pie you can think of. I\'ve included all my tips and tricks for the best pie crust whether you\'re making it the old fashioned way by hand or with a food processor.'),
(10, 'Strawberry Cheesecake', 'Add Graham crackers, toasted pecans, brown sugar, and salt to a food processor and pulse until you have fine crumbs. Pour in the melted butter while pulsing then remove the blade and mix once more with a spatula. This can be done without a food processor by mincing the nuts, crushing the crackers in a bag and mixing everything together in a bowl Dump the mixture into your springform pan and spread out. Use a flat-bottomed glass to press the crust together; press hard, it helps the crust really hold together. I like to bake the crust for 10 minutes at 350F, as it brings out the flavor,  but you can pop it right into the freezer if you don’t want to turn the oven on. Add the hulled strawberries, sugar, lemon juice, and corn starch to a blender and pulse until liquified. Transfer the mixture into a pot and bring to a boil over medium-high heat. Reduce heat to low and simmer until thickened and reduced by about half. Beat the room temperature cream cheese for a minute to loosen it up then add the sugar and mix until smooth. Scrape the bowl down and pour in the sweetened condensed milk, vanilla, and lemon juice while running your mixer on low. Add about half a cup of the chilled reduction and mix in on low. Scrape the bowl down and mix once more until smooth. You can add a bit more reduction to taste if desired. Pour the filling into your prepared crust and smooth the top. Cover and refrigerate overnight. After your cheesecake has set up it’s time to spread the remaining reduction onto the top. Use an offset spatula or knife to smooth it out. You can serve as is, garnish the cheesecake with lots of strawberry slices, or pipe dollops of whipped cream using a star tip and top with thin slices of strawberries. The strawberry slices will dry out quickly so place them on just before serving. \r\n\r\n \r\n\r\n', '2021-02-03 21:41:08', 2, 'cheesecake.jpeg', 'This dreamy no bake strawberry cheesecake has a light and creamy filling flavored with an easy fresh strawberry reduction all in crispy Graham cracker crust. ');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `idUloge` int(255) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`idUloge`, `naziv`) VALUES
(1, 'admin'),
(2, 'korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`idAnkete`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`idKategorije`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`idKomentar`),
  ADD KEY `idKorisnika` (`idKorisnika`),
  ADD KEY `idPosta` (`idPosta`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`idKorisnika`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idUloge` (`idUloge`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`idMeni`);

--
-- Indexes for table `ocena`
--
ALTER TABLE `ocena`
  ADD PRIMARY KEY (`idOcena`),
  ADD KEY `idPosta` (`idPosta`),
  ADD KEY `idKorisnika` (`idKorisnika`);

--
-- Indexes for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD PRIMARY KEY (`idOdgovora`),
  ADD KEY `idAnkete` (`idAnkete`);

--
-- Indexes for table `odgovorianketa`
--
ALTER TABLE `odgovorianketa`
  ADD PRIMARY KEY (`idOdgovorAnketa`),
  ADD KEY `idOdgovora` (`idOdgovora`),
  ADD KEY `idAnkete` (`idAnkete`),
  ADD KEY `idKorisnika` (`idKorisnika`);

--
-- Indexes for table `poruke`
--
ALTER TABLE `poruke`
  ADD PRIMARY KEY (`idPoruke`);

--
-- Indexes for table `posaljirecept`
--
ALTER TABLE `posaljirecept`
  ADD PRIMARY KEY (`idRecept`);

--
-- Indexes for table `postovi`
--
ALTER TABLE `postovi`
  ADD PRIMARY KEY (`idPosta`),
  ADD KEY `idKategorije` (`idKategorije`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`idUloge`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `idAnkete` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `idKategorije` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `idKomentar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `idKorisnika` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `idMeni` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ocena`
--
ALTER TABLE `ocena`
  MODIFY `idOcena` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `odgovori`
--
ALTER TABLE `odgovori`
  MODIFY `idOdgovora` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `odgovorianketa`
--
ALTER TABLE `odgovorianketa`
  MODIFY `idOdgovorAnketa` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `poruke`
--
ALTER TABLE `poruke`
  MODIFY `idPoruke` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posaljirecept`
--
ALTER TABLE `posaljirecept`
  MODIFY `idRecept` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `postovi`
--
ALTER TABLE `postovi`
  MODIFY `idPosta` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `idUloge` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`idKorisnika`) REFERENCES `korisnici` (`idKorisnika`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentari_ibfk_2` FOREIGN KEY (`idPosta`) REFERENCES `postovi` (`idPosta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`idUloge`) REFERENCES `uloga` (`idUloge`);

--
-- Constraints for table `ocena`
--
ALTER TABLE `ocena`
  ADD CONSTRAINT `ocena_ibfk_1` FOREIGN KEY (`idPosta`) REFERENCES `postovi` (`idPosta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ocena_ibfk_2` FOREIGN KEY (`idKorisnika`) REFERENCES `korisnici` (`idKorisnika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD CONSTRAINT `odgovori_ibfk_1` FOREIGN KEY (`idAnkete`) REFERENCES `anketa` (`idAnkete`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `odgovorianketa`
--
ALTER TABLE `odgovorianketa`
  ADD CONSTRAINT `odgovorianketa_ibfk_1` FOREIGN KEY (`idAnkete`) REFERENCES `anketa` (`idAnkete`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `odgovorianketa_ibfk_2` FOREIGN KEY (`idOdgovora`) REFERENCES `odgovori` (`idOdgovora`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `odgovorianketa_ibfk_3` FOREIGN KEY (`idKorisnika`) REFERENCES `korisnici` (`idKorisnika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postovi`
--
ALTER TABLE `postovi`
  ADD CONSTRAINT `postovi_ibfk_1` FOREIGN KEY (`idKategorije`) REFERENCES `kategorije` (`idKategorije`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
