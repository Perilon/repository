// Flite Indic Synthesis Demo Javascript files

// Global variables
var currentVoice = "";
var currentExample = "";
var currentExampleArray = "";
var UserName = "";
var UserEmail = "";

var hindi_examples = [
	"गाँव में इतने आदमी तो हैं, किस पर बेदखली नहीं आई, किस पर कुड़की नहीं आई।",
	"साहित्य और संगीत के प्रेमी थे, ड्रामा के शौकीन, अच्छे वक्ता थे, अच्छे लेखक, अच्छे निशानेबाज़।",
	"उसने परास्त हो कर होरी की लाठी, मिरजई, जूते, पगड़ी और तमाखू का बटुआ ला कर सामने पटक दिए।",
	"सारी देह ढल गई थी, वह सुंदर गेहुँआँ रंग सँवला गया था, और आँखों से भी कम सूझने लगा था।",
	"दो कदम साथ चलनेवाला वह ब्राह्राण, घड़ी भर की पहचान के कारण, मेरे शील की रक्षा करते मरा पड़ा है।",
	"गरज कर कहता, जो मन मे आये कर लो, मथुरा तो अखाड़ा छोडकर हांकने न जायेंगे !",
	"मैं पूछ रहा था, कि उसके जीवन में कोई ऎसा आकर्षण भी है कि जिससे जीने की इच्छा तीव्र हो?",
	"अब तुमसे सच कहता हूँ, मालिक नब्बे रुपए देते थे, पर उनके यहाँ गऊओें की क्या कदर।",
	"अतः रानी अपनी कटार स्वयं ही अपने सीने में भोंककर आत्म बलिदान के पथ पर बढ़ गयीं.",
	"होरी कंधों पर लाठी रख कर घर से निकला, तो धनिया द्वार पर खड़ी उसे देर तक देखती रही।",
	"झुनिया एक हाथ में भरी हुई चिलम, दूसरे में रस का लोटा लिए बड़ी फुर्ती से आ पहुँची।",
	"दीवाली के दिनों में भी ब्राह्मण जो कुछ, जिस तरह करता, नाई भी वही सब, उसी तरह करने लगा।",
	"सच भी है कब से तना खड़ा है, सड़ गल कर सूराख हो जाना क्या ताज्जुब ?",
	"बहू उनके पॉँव नहीं दबाती, उनके सिर में तेल नहीं डालती, तो इसमें मेरा क्या दोष?",
	"काश, वह उनकी इतनी विनती स्वीकार कर ले कि कल दो घण्टे के लिए उनके वीरान घर को रौशन करे!",
	"कहीं जंगली सुअरों के गोल, कहीं नीलगायों के रेवड़, चिलम के सिवा कोई साथी नहीं, आग के सिवा कोई मददगार नहीं।",
	"मुझे ऑंख में धूल डालने की ज़रुरत ना थी, वे आप ही मेरी खातिर कर दिया करते थे।",
	"तुम इसी वक्त उनको सुंदर वस्त्राभूषणों से सजाकर मेरे सामने लाओं ख़बरदार, ज़रा भी देर न हो!",
	"तुम्हीं बताओ, किसी मुसलमान ने जबरदस्ती मुझे अपना उच्छिट भोजन खिला दिया होता तो मुझे स्वीकार करतीं?",
	"आप इतनी दूर से आए, इस कड़ी धूप में सिकार किया, मैं कैसे उठा ले जाऊँ?",
	"बस, जीवन का पूरा विकास इसी में है कि दुनिया को लूटे जाओ और निर्द्वंद्व विलास किए जाओ!",
	"आज उसने अपने ज्ञान और अनुभव से भरी बातें और अपने सतत्व के बखान से मुग्ध कर लिया।",
	"सितार वह सब बजावें, हरमुनियाँ वह सब बजावें, नाचें वह, गावें वह, लेकिन ब्याह कोई न करती थी।",
	"कहती है, ऐसा मर्द ही नहीं देखा कि जब बातें करेंगे, नीची आँखें करके कभी सिर नहीं उठाते।",
	"देख, इस एक बाघ को तो मैंने अन्दर बन्द किया ही है, और अब तेरी बारी है।",
	"दोनो इस वक़्त इस शान से बैठे पूड़ियाँ खा रहे थे जैसे जंगल में कोई शेर अपना शिकार उड़ा रहा हो.",
	"गाड़ी में साँस लेने की जगह नहीं, खिड़की पर जरा सॉँस लेने खड़ा हो गया, तो उस पर इतना क्रोध!",
	"दूसरों को, चाहे वे उसके पेट के जन्मे पुत्र ही क्यों न हों, उसके कामों में हस्तक्षेप करने का क्या अधिकार?",
	"देखा सारा खेत रौदां पड़ा हुआ है और जबरा मॅड़ैया के नीचे चित लेटा है, मानो प्राण ही न हों ।",
	"शहर के रईस और हुक्काम एक तरफ, कालेज के छात्र दूसरी तरफ बैठे भोजन कर रहे थे।",
	"चरित्र तो किसी के माथे पर लिखा नही रहता और शिक्षा का आजके के जमाने में मूल्य ही क्या ?",
	"देश की क्या हालत है, लोगों को खद्दर नहीं मिलता, आप रेशमी साड़ियां खरीद रहे हैं !",
	"विलायती पर तो जल्द विालयती का यक़ीन आयेगा नहीं, देशी की तो बात ही क्या है !",
	"अच्छी आज़ादी की लड़ाई है जिसमें व्यक्ति की आज़ादी का इतना बेदर्दी से खून हो !",
	"तिस पर भी मुंशी जी को गंगा में डूब मरने या कहीं भाग जाने की जरुरत न होती थी !",
	"दिल पर जो कुछ बीतती थी, वह दिल में ही सहती थी और जब न सहा गया,.",
	"सेवैयों के लिए दूध और शक्कर घर में है या नहीं, इनकी बला से, ये तो सेवेयां खाऍंगे।",
	"तथाकथित महान मुगल शासक अकबर भी राज्य को जीतकर रानी को अपने हरम में डालना चाहता था.",
	"इसलिए न कि जानते हो, इसे कहीं टिकना नहीं है, मेरी ही रोटियों पर पड़ी हुई है या और कुछ!",
	"वह टूटे हुए तारों का राग,था जिसमें न वह लोच था न वह जादू न वह असर।",
	"मैं ही अभागिनी हूँ मैं ही त्याज्य हूँ मैं ही कलमुंही हूँ इसीलिए न कि परवश हूँ!",
	"अगर भगवान् की इच्छा है कि मेरे गर्भ से कोई पुत्र न जन्म ले तो मेरा क्या दोष!",
	"देखो, ऋषियों में दधीचि का जो यश है, हरिश्चंद्र की जो कीर्ति है, सेवा त्याग है, आदि।",
	"कई हफ्तों के बाद, छावनी रेलवे से एक मील पश्चिम की ओर सड़क पर कुछ हड्डियाँ मिलीं।",
	"विलास में रत, कालेजों के शौकीन प्रोफेसर विद्यार्थियों पर कोई अच्छा असर नहीं डाल सकते ।",
	"इतनी प्रतिकूल दशाओं में पड़कर भी जिसका हृदय इतना पवित्र, इतना निष्कपट, इतना सदय हो, वह आदमी नहीं देवता है।",
	"जिसकी बाँह पकड़ी, उसका निबाह करना चाहिए कि मुँह में कालिख लगा कर भाग जाना चाहिए!",
	"जब इसने झूठी कसम खा ली, जो बड़ा धर्मात्मा बनता है, तो हीरा का क्या विश्वास?",
	"इससे तो कहीं अच्छा है कि एक गवर्नर रहे, चाहे वह हिंदुस्तानी हो, या अंग्रेज़, इससे बहस नहीं।",
	"मुझमें जितनी बुद्धि, जितना बल है, वह इस इलाके के प्रबंध में ही खर्च हो जाता है।"
];
var kannada_examples = [
	"ಮೈಸೂರು ವಿಶ್ವವಿದ್ಯಾಲಯವು ಭಾರತದ ಒಂದು ಪ್ರಮುಖ ವಿಶ್ವವಿದ್ಯಾಲಯ ",
	"ಪಶ್ಚಿಮ ಬಂಗಾಳದ ಪ್ರಥಮ ಮಹಿಳಾ ಮುಖ್ಯಮಂತ್ರಿ",
	"ರಾಜಕುಮಾರ್ ಜೀವನ ಹಾಗೂ ಸಾಧನೆ ಕುರಿತು ಹ್ಲಾದರಾವ್ ಬರೆದ ಬಂಗಾರದ ಮನುಷ್ಯ ಅತ್ಯಂತ ಜನಪ್ರಿಯ ಪುಸ್ತಕ",
	"ಹರಿಹರ ಊರು ದಾವಣಗೆರೆ ಜಿಲ್ಲೆ ಒಂದು ತಾಲ್ಲೂಕು ಕೇಂದ್ರ",
	"ಉತ್ತರದಲ್ಲಿ ಭೀಮಾ ನದಿ ಮತ್ತು ದಕ್ಷಿಣದಲ್ಲಿ ಕೃಷ್ಣಾ ನದಿಗಳು ಹರಿಯುತ್ತದೆ",
	"ಮಠಗಳು ಪದವನ್ನು ಬೇರೆ ಲೇಖನಗಳಲ್ಲಿ ಹುಡುಕಿ",
	"ಶುಕ್ರ ಇದು ಸೂರ್ಯ ನಿಗೆ ಎರಡನೇ ಅತಿ ಸಮೀಪದ ಗ್ರಹ",
	"ಇದರ ಉಪಯೋಗದ ಬಗ್ಗೆ ಹೆಚ್ಚಿನ ಮಾಹಿತಿ ಇಲ್ಲ",
	"ಧರ್ಮಶ್ರೀ ಎಸ್ ಎಲ್ ಭೈರಪ್ಪನವರ ಪ್ರಥಮ ಕೃತಿ",
	"ಅ ಯೋಜನೆಯ ಪ್ರಕಾರ ಪುಣೆ ಯ ಹಿರಿಯ ಸ್ವಾತಂತ್ರ್ಯ ಹೋರಾಟಗಾರ",
	"ಚಾಲುಕ್ಯರ ಶಾಸನಗಳ ಭಾಷೆ ಕನ್ನಡ ಮತ್ತು ಸಂಸ್ಕೃತ",
	"ಚದುರಂಗ ಆಟದ ಬಗ್ಗೆ ಮಾಹಿತಿಗೆ ಈ ಲೇಖನವನ್ನು ಓದಿ",
	"ಜೀವಶಾಸ್ತ್ರ ದಲ್ಲಿ ಪ್ರಾಣಿ ಗಳನ್ನು ಅಧ್ಯಯನ ಮಾಡುವ ವಿಧಾನ",
	"ಜಿಲ್ಲೆ ಹರಿಹರ ತಾಲೂಕಿನ ಒಂದು ಮುಖ್ಯ ಊರು",
	"ಮರಾಠಿ ಲೇಖಕರು ಪದವನ್ನು ಬೇರೆ ಲೇಖನಗಳಲ್ಲಿ ಹುಡುಕಿ",
	"ಮುಂದೆ ಕರ್ನಾಟಕ ವಿಶ್ವವಿದ್ಯಾಲಯ ದಲ್ಲಿ ಇತಿಹಾಸದಲ್ಲಿ ಎಂ.ಎ. ಪದವಿ ಗಳಿಸಿದರ",
	"ಜ್ಞಾನಪೀಠ ಪ್ರಶಸ್ತಿ ಪಡೆದ ಕನ್ನಡ ಸಾಹಿತಿಗಳ ಪಟ್ಟಿ ಹೀಗಿದೆ",
	"ಹಿಂದೂ ಧರ್ಮದ ಚಾಂದ್ರಮಾನ ಪಂಚಾಂಗದ ಎರಡನೇ ಮಾಸ",
	"ಪ್ರವಾಸೋದ್ಯಮ ದೇಶದ ಪ್ರಮುಖ ಆರ್ಥಿಕ ಚಟುವಟಿಕೆ",
	"ಇದರ ಬಗ್ಗೆ ಅವರಿಗೆ ಯಾವುದೇ ಉತ್ತರ ಬರಲಿಲ್ಲ",
	"ಈ ಸಾಹಿತಿ ದಂಪತಿಗಳ ಏಕೈಕ ಪುತ್ರಿ ಎಮ್.ಎ. ಪದವಿ ಪಡೆದು",
	"ನೆಪ್ಚೂನ್ ಗ್ರಹವು ಮಂದವಾದ ಗ್ರಹ ಉಂಗುರ ವ್ಯವಸ್ಥೆಯನ್ನು ಹೊಂದಿದ್ದು ಈ ಉಂಗುರಗಳ ರಚನೆಯ ವಿವರಗಳು ಇನ್ನೂ ತಿಳಿದುಬಂದಿಲ್ಲ",
	"ಅಕ್ಬರನ ಕಾಲದಲ್ಲಿ ಮುಘಲ್ ಸಾಮ್ರಾಜ್ಯದಲ್ಲಿ ಹಿಂದೂ ಗಳು ಮತ್ತು ಮುಸ್ಲಿಮರು ಇದ್ದರು",
	"ಇದು ಮುಖ್ಯವಾಗಿ ಭಾರತ ಹಾಗೂ ನೆರೆಯ ದೇಶಗಳಲ್ಲಿ ಹೆಚ್ಚಾಗಿ ಕಂಡು ಬರುವ ಮರ",
	"ಈ ವರ್ಗದಲ್ಲಿ ವಿಜ್ಞಾನಿ ಗಳ ಬಗ್ಗೆ ಲೇಖನಗಳಿವೆ",
	"ಮೈಸೂರು ವಿಶ್ವವಿದ್ಯಾನಿಲಯ ದಲ್ಲಿ ಇಂಗ್ಲಿಷ್ ಬಿ.ಏ. ಮತ್ತು ಎಮ್.ಏ. ಪದವಿ ಗಳಿಸಿ ಅಧ್ಯಾಪಕರಾದರು",
	"ಇದು ಆಸ್ಟ್ರೇಲಿಯಾದ ಈಶಾನ್ಯ ಕ್ಕೆ ಇದೆ",
	"ಇದರ ಬಗ್ಗೆ ನಿಮಗೆ ಪ್ರಶ್ನೆಗಳಿದ್ದರೆ ಅದನ್ನು ನನ್ನ ಚರ್ಚೆ ಪುಟದಲ್ಲಿ ಕೇಳಿ",
	"ಸಾಹಿತ್ಯ ಮತ್ತು ಪರಂಪರೆ ಕೃತಿಗೆ ಆರ್",
	"ಇವರು ನವೋದಯ ಕಾಲದ ಹೆಸರಾಂತ ಸಾಹಿತಿ",
	"ಮೈಸೂರು ವಿಶ್ವವಿದ್ಯಾಲಯ ನೀಡಿದ ಗೌರವ ಡಿ.ಲಿಟ್",
	"ಹವ್ಯಕ ಕನ್ನಡಿಗರು ಪದವನ್ನು ಬೇರೆ ಲೇಖನಗಳಲ್ಲಿ ಹುಡುಕಿ",
	"ಟಿ ಎನ್ ಸೀತಾರಾಂ ರವರು ಇದರ ಪ್ರಧಾನ ನಿರ್ದೇಶಕರು",
	"ರಾಮಕೃಷ್ಣ ಹೆಗಡೆ ಯವರು ಈ ಚಿತ್ರದಲ್ಲಿನ ಪ್ರಧಾನ ಪಾತ್ರದಲ್ಲಿ ನಟಿಸಿದ್ದಾರೆ",
	"ಶ್ರೀ ಮಧ್ವಾಚಾರ್ಯರು ಅನೇಕ ಕೃತಿಗಳನ್ನು ಸಂಸ್ಕೃತದಲ್ಲಿ ಬರೆದಿದ್ದಾರೆ",
	"ದಕ್ಷಿಣ ಅಮೇರಿಕ ಖಂಡದ ಪ್ರಮುಖರು ಹೆಸರಿನ ಲೇಖನವನ್ನು ನೀವು ಪ್ರಾರಂಭಿಸಬಹುದು",
	"ದಕ್ಷಿಣ ಅಮೇರಿಕ ಖಂಡದ ಪ್ರಮುಖರು ಪದವನ್ನು ಬೇರೆ ಲೇಖನಗಳಲ್ಲಿ ಹುಡುಕಿ",
	"ಧಾರವಾಡ ದ ಕರ್ನಾಟಕ ಕಾಲೇಜಿನಲ್ಲಿ ಭೌತಶಾಸ್ತ್ರ ದ ಅಧ್ಯಾಪಕರಾಗಿ ಸೇವೆ ಸಲ್ಲಿಸಿ ನಿವೃತ್ತರಾಗಿದ್ದಾರೆ",
	"ಇಲ್ಲಿನ ಪ್ರಮುಖ ಭಾಷೆಗಳು ತುಳು ಕೊಂಕಣಿ ಕನ್ನಡ ಮತ್ತು ಬ್ಯಾರಿ ಭಾಷೆ",
	"ಕನ್ನಡದ ಪ್ರಮುಖ ನಿರ್ದೇಶಕ ನಟ ನಾಗೇಂದ್ರರಾಯರು ಇವರ ತಂದೆ",
	"ಅಮೇರಿಕ ಸಂಯುಕ್ತ ಸಂಸ್ಥಾನ ದಿಂದ ಸ್ವಾತಂತ್ರ್ಯ ಪಡೆಯಿತು",
	"ಅಲ್ಲಿ ಉಳಿದ ಭಾರತೀಯರು ಅವರನ್ನು ಸೇರಿಕೊಂಡರು",
	"ರಾಜ್ ಕುಮಾರ್ ಅವರು ಈ ಚಿತ್ರದಲ್ಲಿ ನಟಿಸಿದ್ದರು",
	"ಪಶ್ಚಿಮ ಯುರೋಪಿನ ಅನೇಕ ರಾಷ್ಟ್ರಗಳಲ್ಲಿ ಈ ರೀತಿ ಇದೆ",
	"ಅಂತರರಾಷ್ಟ್ರೀಯ ಕಾನೂನು ಸಾರ್ವಭೌಮ ರಾಷ್ಟ್ರಗಳ ನಡುವಿನ ಉದ್ಯಮ ಸೇನೆ ಪರಿಸರ ಮತ್ತು ಇತರ ವಿಷಯಗಳ ಬಗ್ಗೆ ವಿವರಿಸುತ್ತದೆ",
	"ಸೂರ್ಯನ ಕಾಂತಕ್ಷೇತ್ರವು ಉಂಟುಮಾಡುವ ಹಲವು ಪರಿಣಾಮಗಳನ್ನು ಒಟ್ಟಾಗಿ ಸೌರ ಚಟುವಟಿಕೆಗಳು ಎಂದು ಕರೆಯಲಾಗುತ್ತದೆ",
	"ಅರಮನೆಯ ರಾಯಲ್ ಸ್ಕೂಲ್ ನಲ್ಲಿ ಅವರ ವಿದ್ಯಾಭ್ಯಾಸ ನಡೆಯಿತು",
	"ಸಾಗರ ಇವರು ಕನ್ನಡ ದ ಸಾಹಿತಿಗಳಲ್ಲೊಬ್ಬರು",
	"ಕರ್ನಾಟಕ ದ ಶುಷ್ಕ ವಾತಾವರಣದಲ್ಲಿ ಹೆಚ್ಚಾಗಿ ಕಂಡು ಬರುತ್ತದೆ",
	"ಪುರಾತನ ತುಳು ಲಿಪಿ ಮಲಯಾಳಂ ಲಿಪಿಯನ್ನು ಹೋಲುತ್ತದೆ"
];
var tamil_examples = [
	"அவளுக்கு என்ன தெரியும் என் கவலை?",
	"இதற்கான வரவேற்பு எப்படி இருந்தது அங்கே?",
	"எந்த வேலைக்கு எவ்வளவு சம்பளம், எந்த",
	"அது எப்படி அவ்வளவு நிச்சயமா சொல்றீங்க?",
	"இன்னொரு ரொம்ப நல்ல கேள்வி சூர்யா!",
	"அவனுக்கு ஆயிரம் ஆண்டுகளுக்குப் பிறகு கம்பன்",
	"ஆனால், அது வரை நான் ஒரு மைக்ரோசா·ப்ட் ஆள்!",
	"வழக்கம் போல 'அன்புள்ள சிநேகிதியே' சுவையாக இருந்தது.",
	"நான் இதை முழுமையாக ஏற்றுக் கொள்ள முடியாது.",
	"ஆனா நிச்சயமா சொல்ல முடியாது என்றார்.",
	"குறிப்பாக, குடும்ப வரலாறு உள்ளவர்கள் பார்த்துக் கொள்ள வேண்டும்.",
	"நவீன ஓவியங்கள் பற்றி உங்கள் கருத்து என்ன?",
	"உங்கள் கல்வி பின்னணி, மற்றும் தற்போதைய வேலை இவற்றைப் பற்றிச் சற்று கூற முடியுமா?",
	"அந்தத் தொடர் ஓவியம் நல்ல வரவேற்பைப் பெற்றது.",
	"அவர்தான் உங்களுக்கு இதுபோன்ற விஷயங்களில் ஈடுபாடு இல்லை என்றார்.",
	"எதைச் செய்தாலும் சிறப்பாக செய்ய வேண்டும்.",
	"உங்களுக்கு இதற்கு மேல் என்ன விவரம் வேண்டும்?",
	"பாவம், என்னால் தானே உனக்கு இந்த நிலை?",
	"எங்கள் வீட்டில் புத்தகங்கள் வாங்க, படிக்கத் தடை.",
	"அதுவரை நாம் காத்துக் கொண்டுதான் இருக்க வேண்டும்.",
	"இந்த வீடு என்ன விலைக்கு போகும்?",
	"ஆனால் அதற்கு ஒரு காரணம் இருக்கிறது.",
	"நீங்கள் இதுவரை எழுதிய தமிழ்ப் புத்தகங்கள் பற்றிக் கூற முடியுமா?",
	"அம்மாவை அழைத்து வைத்துக் கொண்டு நன்றாகப் பார்த்துக் கொள்ள வேண்டும் என்று ஆசை.",
	"மூன்று மாதம் தானே அட்ஜஸ்ட் பண்ணிக் கொள்ள வேண்டியது தான் என்கிறார்.",
	"வேலை செய்வதற்கு அருமையான இடம் இது.",
	"இதில் மட்டும் அமெரிக்கா, இந்தியா என்று வித்தியாசம் இல்லை.",
	"இந்தத் தலை எழுத்து உங்களுக்கு ஏன்?",
	"முதலில் ஒன்றும் அவ்வளவு ஈடுபாடு இல்லை.",
	"கதை, கவிதை எழுத நிறைய பேர் இருக்கிறார்கள்.",
	"தொலைக்காட்சி, சினிமா போன்ற ஊடகங்கள் மூலம் இலக்கிய வளர்ச்சிக்கு ஏதாவது செய்ய முடியுமா?",
	"அந்த இரவில் என் கருத்தில் தோன்றிய முதல் பாடலின் முதல் சில வரிகள்",
	"ஒருநாள் ராத்திரி இரண்டு மணி இருக்கும்.",
	"இது என்னுடைய நீண்ட நாள் கனவு.",
	"அதனால் ஊசி மாதம் ஒருமுறை தேவைப்படும்.",
	"என்ன செய்வது, அது மாதிரியான சூழல் இங்கே இருக்கிறது.",
	"நமக்கு என்று ஓர் கலாசாரம் இருக்கிறது.",
	"அதற்கு நான் எங்கள் அலுவலகத்தில் கேட்க வேண்டும்",
	"இது ஒரு பெரிய விஷயம் தான்.",
	"எனக்குத் தெரியாம உங்களுக்கு எப்படித் தெரிய முடியும்?",
	"எப்படி இருந்தாலும், இந்தத் திருமணம் நடக்கும்.",
	"அந்தக் குழந்தைக்கு இப்போது மூன்று வயது.",
	"ஆனால் அதற்கு ஒரு அளவு இருக்கிறது.",
	"உங்களைப் பார்த்தால் எனக்கு என் அம்மா ஞாபகம் வருகிறது.",
	"தமிழ் இணைய மாநாடு என்றால் என்ன?",
	"மத்தியில் படுக்கை கொண்ட பெரிய அறை அது.",
	"இப்போ சூர்யா சொல்லித் தான் தெரியும் என்றார்.",
	"அவரது ஓய்வு வாழ்க்கை சிறப்பாக அமைய நமது வாழ்த்துக்கள்.",
	"அப்போது நீங்கள் அங்கே இருக்க வேண்டும்.",
	"எனக்கு ரொம்பக் கோபம் வந்து விட்டது."
];
var marathi_examples = [
	'हा एकेरी मार्ग असल्याचे पोलिसांनी सांगितले.' ,
	'दरम्यान, पुढील महिन्याच्या पहिल्या आठवड्यात कॉंग्रेस जनजागृती आंदोलन हाती घेणार आहे.' ,
	'लोकरे यांना निलंबित करण्याचा कोणताही अधिकार नाही, हे मांडले.' ,
	'याबाबत येथील पोलिस ठाण्यात अपघाताची नोंद केली आहे.' ,
	'कोणाला त्याचे छायाचित्र तर कोणाला त्याची सही हवी होती.' ,
	'जिल्ह्याच्या विकासासाठी आम्ही प्रयत्न केला.' ,
	'त्याला रात्री वीज देऊन फायदा नाही.' ,
	'त्यानुसार हे उद्‌घाटन होत आहे.' ,
	'इतर दोघांना बेदम मारहाण केली.' ,
	'त्यामुळे शेतकऱ्यांना कर्ज घ्यावे लागते.' ,
	'विहीर हवी असल्यास पैसे द्या अशी मागणी केली.' ,
	'या सर्व प्रकाराची चौकशी करून दोन दिवसांत निर्णय घेण्यात येईल असे आश्‍वासन श्री.' ,
	'मात्र, थकबाकी वसूल करून हे काम करावे, असा ठराव करण्यात आला.' ,
	'किंबहुना त्यांच्यावर ते बंधनकारक होते;' ,
	'ओळख घातली की साक्षीदार निघून गेला.' ,
	'हजारे यांनी जरूर आंदोलन करावे, आम्ही पाठीशी राहू.' ,
	'त्या नंतर लोक खरेदीसाठी बाहेर पडले;' ,
	'त्यांची येथील ज्ञानेश्‍वर वाचन मंदिरात सायंकाळी साडेसहा वाजता सभा झाली.' ,
	'कंपनीची आर्थिक बाजू मजबूत होऊन कामगारांना फायदा होईल.' ,
	'इच्छुक उमेदवारांनी अर्ज घेण्यासाठी गर्दी केली होती.' ,
	'त्यांच्या मागे पत्नी, एक मुलगा, एक मुलगी आहे.' ,
	'पोलिस ठाण्यात आकस्मिक मृत्यूची नोंद करण्यात आली आहे.' ,
	'एखादा प्रकल्प संपल्यानंतर कार्यकर्त्यांना दुसऱ्या प्रकल्पात आतापर्यंत सामावून घेतले जात होते;' ,
	'येथे झालेल्या बैठकीत निश्‍चित करण्यात आली.' ,
	'दरम्यान, गावातील नागरिकांनी पोलिस ठाण्यात प्रचंड गर्दी केली होती.' ,
	'या संदर्भात प्रवाशांनी तक्रारी केल्या;' ,
	'अशी शिक्षा मिळालेल्या आरोपींची नावे आहेत.' ,
	'मात्र, विषारी औषध का घेतले याची माहिती मिळू शकली नाही.' ,
	'नंतर त्याचे डोळे बांधून त्याला अज्ञात ठिकाणी नेण्यात आले.' ,
	'या घटनेची नोंद पोलिस ठाण्यात झाली असून, तपास सुरू आहे.' ,
	'रात्रीच्या सुमारास मृत्यू झाला.' ,
	'कर्मचाऱ्यांनी आंदोलन मागे घेऊन कामावर हजर राहावे;' ,
	'जमिनीच्या बदल्यात दिलेल्या जमिनी या लांब;' ,
	'यावेळी ज्या उपाययोजना करण्यात येत आहेत, त्या अधिक वेगाने व चांगल्या पद्धतीने करण्याची गरज आहे.' ,
	'थोडा वेळ गेल्यानंतर म्हणाले, माफ करा.' ,
	'गणपती मंडळांनी पोलिसांना सहकार्य करण्याचे आवाहन.' ,
	'तेवढी जागा इथे उपलब्ध होणार का?' ,
	'श्‍याम देशपांडे नैसर्गिक आपत्ती नव्हे;' ,
	'न्यायालयाचे आदेश कायम असल्याने आज काय होणार, याची उत्सुकता होती;' ,
	'प्रत्येक राज्यात स्वतंत्र गुन्हा चौकशी संस्था स्थापन करा.' ,
	'त्यानंतर दिल्ली दर्शन सुरू झाले. ',
	"आकस्मिक मृत्यूची नोंद करण्यात आली आहे.",
	"ही दुर्घटना शुक्रवारी पहाटे साडेचार वाजता घडली.",
	"फसवणूक झालेल्या आणखी विद्यार्थ्यांची नावे निष्पन्न होण्याची शक्‍यता आहे, असे पोलिस निरीक्षक जयवंत देशमुख, फौजदार रवींद्र पाटील यांनी सांगितले.",
	"त्यामुळे समितीच्या बैठकीत भाजपच्या सदस्यांनी विरोध केला.",
	"नऊ ऑगस्ट रोजी राज्यस्तरीय पुरस्कार वितरण मुंबईत होईल.",
	"रास्ता रोको करणाऱ्यांना पोलिसांनी ताब्यात घेऊन नंतर सोडून दिले.",
	"मुंबई क्रिकेट संघटना नवी कार्यकारिणी, अध्यक्ष : शरद पवार.",
	"दरम्यान, पुढील महिन्याच्या पहिल्या आठवड्यात कॉंग्रेस जनजागृती आंदोलन हाती घेणार आहे.",
	"त्या पदावर प्रभारी अधिकारी म्हणून सातारा जिल्ह्याचे पोलिस उपअधीक्षक धनंजय कुलकर्णी यांनी वर्षभर काम पाहिले.",
];
var telugu_examples = [
	"హిందూ సంఘం ఒక కులాల కూటమి",
	"ఈ ఊరు విజయవాడ కు చాలా దగ్గర",
	"ఈ మూస వికీపీడియాకు సంబంధించిన మూస",
	"వీరి ద్వారా ఒక ప్రాధమిక పాఠశాల ఒక హైస్కూలు ఒక  ఐ.టి.ఐ. నడుపబడుతున్నాయి",
	"కుల్కచర్ల ఆంధ్ర ప్రదేశ్ రాష్ట్రములోని రంగారెడ్డి జిల్లాకు చెందిన ఒక మండలము",
	"దిద్దుబాట్లు ఎలా చెయ్యాలి లో ఇటువంటి వివరాలు ఇంకా ఉన్నాయి చూడండి",
	"దాదాసాహెబ్ ఫాల్కే అవార్డు గ్రహీత ప్రదీప్",
	"ప్రధాన రాజకీయ పార్టీలు కాంగ్రెస్ తెలుగు దేశం తెరాస",
	"ఈ వంశము తెలుగు వారిని పరిపాలించిన తొలి ముస్లిం వంశము",
	"దాదాసాహెబ్ ఫాల్కే అవార్డు గ్రహీత అక్కినేని నాగేశ్వరరావు",
	"దాదాసాహెబ్ ఫాల్కే అవార్డు గ్రహీత  ఎల్.వి.ప్రసాద్ ",
	"ప్రపంచంలో రెండవ అతిపెద్ద సాఫ్టువేరు సంస్థ",
	"కడప జిల్లాకు సంబంధించిన మంచి సమాచారము ఈ వెబ్ సైట్ లో ఉన్నది",
	"ఇంతకు ముందు అది ఖాళీగా ఉన్న పేజీ గనుక తొలగించి ఉండొచ్చు",
	"భారతదేశ ప్రాజెక్టు వ్యాసాల వర్గాల వర్గీకరణ",
	"పంచాయత్ రాజ్ మంత్రిత్వ శాఖ వెబ్‌సైటులో కర్నూలు జిల్లా తాలూకాల వివరాలు ఉన్నాయి ",
	"ప్రసాద్ పేరిట ఓ పేజీ ఇప్పటికే ఉంది",
	"ఏక సంస్కృతం అయినప్పటికీ తెలుగు వాడుకలో ఒక మాటల కంటే ఏక మాటల కంటె ఎక్కువ",
	"శ్రీకాకుళం ఘంటసాల ప్రసిద్ధి చెందిన ఆంధ్ర విష్ణు దేవాలయం ఉన్న వూరు",
	"వాటిని ఫొటోలు తీసి ఆయా సినిమాలకు సంబంధించిన వ్యాసాలలో ఉంచండి",
	"మసిద్ వ్యాసానికి జత చేస్తాను రెండు మూడు రోజులలో",
	"తల్లి వేరు వ్యవస్థ ద్విదళజీజ మొక్కలలో  కనిపిస్తుంది",
	"ఎడమ పక్కన ఉన్న ఇటీవలి మార్పులు ను నొక్కండి",
	"ఈయన భారతీయ గణిత శాస్త్ర సమాజానికి కార్యదర్శి కూడా",
	"ప్రపంచ సాహిత్యంలో ఇది గొప్ప రచన",
	"ఈ దేవాలయానికి ఎదురుగా చెరువు మధ్యలో నిర్మించిన మండపం ప్రత్యేక ఆకర్షణ",
	"ఎడమ కాలువ నల్గొండ జిల్లాకు నీటి సరఫరా చేస్తుంది",
	"పోలవరం పశ్చిమ గోదావరి జిల్లాకు చెందిన ఒక మండలము ",
	"వచ్చే వారం బొమ్మ ఏర్పాట్లు ఇంకా పూర్తి కాలేదు",
	"అప్పుడు మంత్రి ఇలా అన్నాడు రాజా మీరు గనుక నన్ను చెరసాలలో బంధించి ఉండకపోతే నేనూ అడవికి వచ్చేవాడిని ",
	"కావలి శ్రీకాకుళం జిల్లా సంతకవిటి మండలానికి చెందిన గ్రామము",
	"అలాగే మీరు అప్లోడు చేసిన మిగతా బొమ్మలకు కూడా లైసెన్సు వివరాలు చేర్చండి",
	"వారు నిర్మించిన కోట ఈ గ్రామములొ ఒక ఆకర్షణ",
	"శ్రీ సత్యనారాయణ స్వామి దేవాలయం ఈ ఊరికి ప్రధాన ఆకర్షణ",
	"ఇదే ఆమె యొక్క ఏకైక సెంచరీ",
	"అటువంటి ప్రాంతాలలో ముఖ్య మంత్రి పదవి కూడా వుంటుంది",
	"ఈ చిత్రంలో ప్రఖ్యాత నటులు ఎన్.టి.ఆర్ కృష్ణుడిగా అధ్బుతమైన పాత్రను పోషించగా ఏ.ఎన్.ఆర్ అర్జునిడిగా తన ప్రతిభను చూపారు ",
	"ఉదాహరణకు నా సంతకం ఇలా ఉంది",
	"భక్తులకు ప్రత్యేక సౌకర్యాలు ఏర్పాటు చేస్తారు",
	"ఆంగ్ల వికీపీడియాలో కాపీహక్కుల గురించి ఇక్కడ ఇచ్చారు భారతదేశ కాపీహక్కుల చట్టం గురించి ఇక్కడ ఇచ్చారు",
	"ఇది తెలుగులో మొదటి సాంఘిక చిత్రం",
	"పంచాయత్ రాజ్ మంత్రిత్వ శాఖ వెబ్‌సైటులో తూర్పు గోదావరి జిల్లా తాలూకాల వివరాలు",
	"ఈ ఆలయంలో దసరా ఉత్సవాలు ఘనంగా నిర్వహిస్తారు",
	"కాసుబాబు గారు గుడిపాటి వెంకట చలం మరియు చలం రెండూ ఒకే వ్యక్తి గురించి వేర్వేరు పేర్లతో వ్యాసాలున్నాయి",
	"ఉదాహరణకు మా ఊరి పేజీ చూడండి",
	"రంగారెడ్డి జిల్లా మర్‌పల్లి మండలానికి చెందిన గ్రామము",
	"అదే మంచి ఆలోచన తరువాత లోడ్ చేయండి",
	"ఇటీవలి కొన్ని చిత్రాలలో పాటల రచయితగా కూడా పని చేసారు",
	"ఆ వ్యాసం పై కృషి చేసిన వారి జాబితా  చూడండి ",
	"ఇదే పేరుతో ఉన్న ఇతర ప్రాంతాల కొరకు వల్లూరు అయోమయ నివృత్తి చూడండి"
];
var gujarati_examples = [
	'गांधी कुटुंब प्रथम तो गांधियाणानो वेपार करनारुं होय एम जणाय छे.' ,
	' पण मारा दादाथी मांडीने त्रण पेढी थयां तो ए कारभारुं करतुं आवेलुं छे.' ,
	' उत्तमचंद गांधी अथवा ओता गांधी टेकीला हशे एम लागे छे.' ,
	' तेमने राजखटपटने लीधे पोरबंदर छोडवुं पडेलुं ने जूनागढ राजयमां आश्रय लीधेलो.' ,
	' तेमणे नवाबसाहेबने सलाम डाबे हाथे करी.' ,
	' कोइए आ देखाता अविनयनुं कारण पूछयुं तो जवाब मळ्यो : ‘जमणो हाथ तो पोरबंदरने देवाइ चूकयो छे.’ ओता गांधीने एक पछी एक एम बे घर थयेलां.' ,
	' पहेलाथी तेमने चार दीकरा हता अने बीजाथी बे.' ,
	' आ भाइओ ओरमाया हता एवो ख्याल मने बचपण याद करतां आवतो ज नथी.' ,
	' आमांना पांचमा करमचंद अथवा कबा गांधी अने छेल्ला तुलसीदास गांधी.' ,
	' बंने भाइए वाराफरती पोरबंदरमां कारभारुं कर्युं.' ,
	' पोरबंदरनुं कारभारुं छोडया पछी पोते राजस्थानिक कोर्टमां सभासद हता.' ,
	' पछी राजकोटमां अने थोडो समय वांकानेरमां दीवान हता.' ,
	' मरणवेळाए राजकोट दरबारना पेन्शनर हता.' ,
	'  कबा गांधीने पण एक पछी एक चार घर थयेलां.' ,
	' पहेलां बेथी बे दीकरीओ हती; छेल्लां पूतळीबाइथी एक दीकरी अने त्रण दीकरा.' ,
	' पिता कुटुंबप्रेमी, सत्यप्रीय, शूरा, उदार पण क्रोधी हता.' ,
	' कंइक विषयने विशे आसकत पण हशे.' ,
	' तेमनो छेल्लो विवाह चाळीसमा वर्ष पछी थयेलो.' ,
	' तेओ लांचथी दूर भागता, तेथी शुद्ध न्याय आपता एवी अमारा कुटुंबमां अने बहार वायका हती.' ,
	' एक वेळा कोइ प्रांतना साहेबे राजकोटना ठाकोर साहेबनुं अपमान करेलुं, तेनी सामे तेओ थयेला.' ,
	' साहेब गुस्से थया, कबा गांधीने माफी मागवा फरमाव्युं.' ,
	' तेमणे माफी मागवानी ना पाडी तेथी थोडा कलाकने सारु हाजतमां पण रहेला.' ,
	' छतां ते न डग्या तेथी अंते साहेबे तेमने छोडी देवानो हुकम कर्यों.' ,
	' पिताश्रीए द्रव्य एकठुं करवानो लोभ कदी नहोतो राख्यो.' ,
	' तेथी अमे भाइओ सारु जूज मिलकत मूकी गयेला.' ,
	'  पितानी केळवणी केवळ अनुभवनी हती.' ,
	' जेने आजे आपणे गुजराती पांच चोपडीनुं ज्ञान गणीए तेटली केळवणी ते पामेल हशे.' ,
	' इतिहासभूगोळनुं ज्ञान तो मुद्दल न मळे.' ,
	' आम छतां व्यवहारु ज्ञान एवा ऊंचा प्रकारनुं हतुं के झीणामां झीणा प्रश्र्नोना उकेल करवामां के हजार माणसोनी पासे काम लेवामां तेमने मुश्केली न आवती.' ,
	' धार्मिक केळवणी नहीं जेवी हती, पण मंदिरोमां जवाथी कथा वगेरे सांभळीने जे धर्मज्ञान असंख्य हिंदुओने सहेजे मळी रहे छे ते तेमने हतुं.' ,
	' छेवटना वर्षमां एक विद्धान ब्राह्मण जेओ कुटुंबना मित्र हता तेमनी सलाहथी तेमणे गीतापाठ शरू कर्यो हतो अने रोज थोडाघणा श्र्लोको पोताना पूजाना समये ऊंचे स्वरे पाठ करी जता.' ,
	' हुं समजणो थयो त्यारथी तेणे कदी चातुर्मास छोडया होय एवुं मने स्मरण नथी.' ,
	' कठणमां कठण व्रत ते आदरती अने निर्विध्ने पूरां करती.' ,
	' लीधेलां व्रत मांदी पडे तोपण न ज छोडे.' ,
	' एवो एक समय मने याद छे के जयारे तेणे चांद्रायण व्रत लीधेलुं, तेमां मांदी पडेली पण व्रतने न छोडेलुं.' ,
	' चातुर्मासमां एक टाणां करवां ए तो तेने सामान्य वात हती.' ,
	' एटलेथी संतोष न वाळतां एक चातुर्मासमां तेणे धारणांपारणां करेलां.' ,
	' बेत्रण सामटा उपवास ए एने मन नजीवी वात हती.' ,
	' एक चातुर्मासमां तेनुं एवुं व्रत हतुं के सूर्यनारायणनां दर्शन कर्या पछी ज जमाय.' ,
	' आ चोमासे अने छोकरा वादळ सामुं जोइ रहीए के कयारे सूर्य देखाय ने कयारे मा जमे.' ,
	' चोमासामां घणी वेळा दर्शन दोह्यलां थाय ए तो सहु जाणे छे.' ,
	' एवा दिवसो याद छे के जयारे सूर्यने अमे जोइए, ‘बा, बा, सूरज देखायो’ कहीए ने बा उतावळी उतावळी आवे त्यां तो सूरज भागी जाय. ‘कंइ नहीं, आजे नसीबमां खावानुं नहीं होय’ कही पाछी जाय ने पोताना काममां गूंथाइ जाय.' ,
	'  आ मात पिताने त्यां हुं संवत १९२५ना भादरवा वद १२ने दिवसे, एटले सने १८६९ना ऑकटोबरनी २जी तारीखे, पोरबंदर अथवा सुदामापुरीमां जन्म पाम्यो.' ,
	' कोइ निशाळमां मने मूकवामां आवेलो एवुं याद छे.' ,
	' मुश्केलीथी  पाडा शीखेलो.' ,
	' ते काळे छोकराओनी साथे हुं महेताजीने मात्र गाळ देतां शीखेलो एटलुं याद छे, अने बीजुं कांइ ज याद नथी.' ,
	' तेथी हुं अनुमान करुं छु के मारी बुद्धि मंद हशे, अने यादशकित जे कडी अमे छोकरा गाता तेमांना काचा पापडना जेवी हशे.' ,
	' ए लीटीओ मारे आपवी ज जोइए:  एकडे एक , पापड शेक; पापड कच्चो, --- मारो―  पहेली खाली जग्याए मास्तरनुं नाम होय.' ,
	' तेने हुं अमर करवा नथी इच्छतो.' ,
	' बीजी खाली जग्यामां छोडी दीधेली गाळ भरवानी आवश्यकता न होय.' 
]

// Functions
function play_tts() {
	document.getElementById('send-errors').innerHTML = "";
	if( (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPad/i)) ) {
		document.getElementById('example-area').innerHTML="<h4 style='color:red;text-align:center;'>Playback and download are not supported on iPhones or iPads</h4><p style='text-align:center;'><input type='submit' value='continue' onclick='continue_session()'></p>";
		document.getElementById('comment-area').style.display='none';
		document.getElementById('example-area').style.display='block';
		document.getElementById('send-errors').innerHTML = "";
	} else {
		document.getElementById('audio-controls').style.display = 'inline';
		document.getElementById('comment-area').style.display = 'block';
		document.getElementById('example-area').style.display = 'none';
		document.getElementById('text-area').style.display = 'none';
		var text = document.getElementById('spoken-text').innerHTML;
		var voice = currentVoice;
		if(currentVoice == 'Gujarati_Female_AXB') voice = 'Hindi_Female_AXB.flitevox';
		var audio = document.getElementById('player');
		audio.setAttribute('src', 'http://tts.speech.cs.cmu.edu:8084/wav?text=' + encodeURIComponent(text) + '&voice=' + encodeURIComponent(voice));
		audio.play();
	}
}
function download_tts() {
	document.getElementById('send-errors').innerHTML = "";
	if( (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPad/i)) ) {
		document.getElementById('example-area').innerHTML="<h4 style='color:red;text-align:center;'>Playback and download are not supported on iPhones or iPads</h4><p style='text-align:center;'><input type='submit' value='continue' onclick='continue_session()'></p>";
		document.getElementById('comment-area').style.display='none';
		document.getElementById('example-area').style.display='block';
	} else {
		document.getElementById('audio-controls').style.display = 'none';
		document.getElementById('example-area').style.display = 'none';
//		var theText = document.getElementById('textarea').value;
//		document.getElementById('spoken-text').innerHTML = theText;
		document.getElementById('comment-area').style.display = 'block';
		document.getElementById('text-area').style.display = 'none';
		var text = document.getElementById('textarea').value;
		var voice = currentVoice;
		if(currentVoice == 'Gujarati_Female_AXB') voice = 'Hindi_Female_AXB.flitevox';
		var audio = document.getElementById('player');
		var downloader = document.getElementById('downloader');
		downloader.setAttribute('href', 'http://tts.speech.cs.cmu.edu:8084/wav?text=' + encodeURIComponent(text) + '&voice=' + encodeURIComponent(voice));
		downloader.click();
	}
}
function continue_session() {
	document.getElementById('send-errors').innerHTML = "";
	document.getElementById('example-area').innerHTML="";
	document.getElementById('comment-area').style.display='block';
	document.getElementById('example-area').style.display='none';
}

function new_language(language) {
	document.getElementById('send-errors').innerHTML = "";
	currentVoice = language;
	currentExample = 1;
	var displayVoice = '';
	document.getElementById('sentence-number').innerHTML = currentExample;
	switch (currentVoice) {
	case 'Hindi_Female_AXB.flitevox':
		currentExampleArray = hindi_examples;
		displayVoice="Hindi Female AXB";
		break;
	case 'Kannada_Female_SMJ.flitevox':
		currentExampleArray = kannada_examples;
		displayVoice = 'Kannada Female SMJ';
		break;
	case 'Marathi_Female_SLP.flitevox':
		currentExampleArray = marathi_examples;
		displayVoice ='Marathi Female SLP';
		break;
	case 'Tamil_Male_SKS.flitevox':
		currentExampleArray = tamil_examples;
		displayVoice = 'Tamil Male SKS';
		break;
	case 'Telugu_Female_KNR.flitevox':
		currentExampleArray = telugu_examples;
		displayVoice = 'Telugu Female KNR';
		break;
	case 'Gujarati_Female_AXB':
		currentExampleArray = gujarati_examples;
		displayVoice = 'Gujarati Female AXB';
		break;
	default:
		currentExampleArray = '';
	}
	document.getElementById('language-icons').style.display='none';
	document.getElementById('choose-a-voice').style.display='none';
	document.getElementById('chosen-voice').style.display='inline';
	document.getElementById('language').innerHTML = displayVoice;
	document.getElementById('sentence-controls').style.display = 'inline';
	document.getElementById('request-buttons').style.display = 'inline';
	document.getElementById('audio-controls').style.display = 'inline';
	document.getElementById('spoken-text').innerHTML = currentExampleArray[currentExample-1];
	document.getElementById('comment-area').style.display = 'block';
	document.getElementById('example-area').style.display = 'none';
	document.getElementById('text-area').style.display = 'none';
	document.getElementById('text-identifier').innerHTML = currentVoice + '&nbsp;&nbsp;&nbsp;&nbsp;Example Sentence: '+ currentExample +':';
}

function new_voice() {
	document.getElementById('send-errors').innerHTML = "";
	document.getElementById('choose-a-voice').style.display='inline';
	document.getElementById('chosen-voice').style.display='none';
	document.getElementById('language-icons').style.display='block';
	document.getElementById('sentence-controls').style.display = 'none';
	document.getElementById('request-buttons').style.display = 'none';
	document.getElementById('audio-controls').style.display = 'none';
	document.getElementById('comment-area').style.display = 'none';
	document.getElementById('example-area').style.display = 'none';
	document.getElementById('textarea').style.display= 'none';
	document.getElementById('text-area').style.display = 'none';
}

function show_examples() {
	document.getElementById('send-errors').innerHTML = "";	
	document.getElementById('comment-area').style.display = 'none';
	var examples = document.getElementById('example-area');
	var exampleString ="";
	var temp=currentVoice;
	
	exampleString = '<ol type="1" style="padding-left:1.5em;list-style:decimal;">';
	for (var i=0;i<currentExampleArray.length; i++) {
		exampleString += "<li style='margin-bottom:.5em;'><a style='text-decoration:none;' name='" + i + "' onclick='choose_example(this.innerHTML, this.name)'>" + currentExampleArray[i] +"</a></li>";
	}
	exampleString +="</ol>";
	examples.innerHTML = exampleString;
	examples.style.display = 'block';
} 

function next_example() {
	document.getElementById('send-errors').innerHTML = "";
	if (currentExample == currentExampleArray.length) currentExample = 1; else currentExample++;
	document.getElementById('sentence-number').innerHTML = currentExample;
	document.getElementById('spoken-text').innerHTML = currentExampleArray[currentExample-1];
	document.getElementById('example-area').style.display = 'none';
	document.getElementById('comment-area').style.display = 'block';
	document.getElementById('text-identifier').innerHTML = currentVoice + '&nbsp;&nbsp;&nbsp;&nbsp;Example Sentence: '+ currentExample +':';
}

function prev_example() {
	document.getElementById('send-errors').innerHTML = "";
	if (currentExample == 1) currentExample = currentExampleArray.length; else currentExample--;
	document.getElementById('sentence-number').innerHTML = currentExample;
	document.getElementById('spoken-text').innerHTML = currentExampleArray[currentExample-1];
	document.getElementById('example-area').style.display = 'none';
	document.getElementById('comment-area').style.display = 'block';
	document.getElementById('text-identifier').innerHTML = currentVoice + '&nbsp;&nbsp;&nbsp;&nbsp;Example Sentence: '+ currentExample +':';
}

function this_example() {
	document.getElementById('send-errors').innerHTML = "";
	currentExample = document.getElementById('sentence-number').innerHTML;
	document.getElementById('spoken-text').innerHTML = currentExampleArray[currentExample-1];
	document.getElementById('text-identifier').innerHTML = currentVoice + '&nbsp;&nbsp;&nbsp;&nbsp;Example Sentence: '+ currentExample +':';
}

function choose_example(string, index) {
	document.getElementById('send-errors').innerHTML = "";
	var value = "";
	if (!string) {
		var radios = document.getElementsByName('exString');
		for (var i = 0, length=radios.length; i < length; i++) {
			if(radios[i].checked) {
				value = radios[i].value;
				break;
			}
		}
	} else {
		value = string;
	}

	if (value != "") {
		document.getElementById('spoken-text').innerHTML = value;
	}
	document.getElementById('sentence-number').innerHTML = Number(index) + 1;
	currentExample = Number(index) + 1;
	document.getElementById('example-area').style.display = 'none';
	document.getElementById('comment-area').style.display = 'block';
	document.getElementById('example-area').style.display = 'none';
	document.getElementById('text-identifier').innerHTML = currentVoice + '&nbsp;&nbsp;&nbsp;&nbsp;Example Sentence: '+ currentExample +':';
}

function text_entered() {
	document.getElementById('send-errors').innerHTML = "";
	document.getElementById('example-area').style.display = 'none';
	var value = document.getElementById('textarea').value;
	var buttons = document.getElementById('request-buttons');
	if (value == "") {
		buttons.style.display = 'none';
		document.getElementById('audio-controls').style.display = 'none';
		document.getElementById('spoken-text').value = "";
		document.getElementById('comment-area').style.display = 'none';
	} else {
		buttons.style.display = 'inline';
	}
}
function new_sentence() {
	document.getElementById('send-errors').innerHTML = "";
	var text_area = document.getElementById('text-area');
	text_area.style.display = 'inline';
	text_area.value = "";
	document.getElementById('request-buttons').style.display = 'none';
	document.getElementById('audio-controls').style.display = 'none';
	document.getElementById('comment-area').style.display = 'none';
	document.getElementById('example-area').style.display = 'none';
	document.getElementById('textarea').value = "";
}
function send_comments() {
	document.getElementById('send-errors').innerHTML = "";
	var user_name = document.getElementById("user-name").value;
	var user_from = document.getElementById("e-mail").value;
	var user_language = currentVoice;
	var user_sentence = document.getElementById('spoken-text').innerHTML;
	var user_comment = document.getElementById('user-comments').value;
	document.getElementById('send-errors').innerHTML = "<p style='margin-top:0;color:red;text-align:center;'>Send in progress</p>";
	var oXHR = new XMLHttpRequest();        
    oXHR.open("POST", "app.php", true);
	oXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	oXHR.onreadystatechange = function() {
		if(oXHR.readyState == 4 && oXHR.status == 200) {
			console.log("in readyState handler for send_comments:");
		    var return_data = oXHR.responseText;
			document.getElementById('send-errors').innerHTML = return_data;
		}
	 }
	// turn off buttons
	var call_id = 'send-comments';
	var vars ="call_id='"+call_id+"'&name='"+user_name+"'&from='"+user_from+"'&lang='"+user_language+"'&sentence='"+user_sentence+"'&comment='"+user_comment+"'";
     oXHR.send(vars);
	return;
}