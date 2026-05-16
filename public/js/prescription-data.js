const drugData = [
    {
        "num": "279",
        "name": "Aciclovir  Antiviral Topical",
        "line1": "Aciclovir 5 % w\/w Cream\\n",
        "desc": "Five times daily at approximately four hourly intervals omitting the night time application."
    },
    {
        "num": "117",
        "name": "Acne combination: Trimethoprim\u00a0and Adapalene",
        "line1": "Acne : Trimethoprim\u00a0and Adapalene",
        "desc": "Trimethoprim\u00a0200mg every 12 hours for 1 month then 300mg every 12 hours for 3 months\\n\\nAdapalene 0.1% Benzoyl Peroxide 2.5% gel (Epiduo)\u00a0Apply twice weekly to affected area to start and slowly increase frequency as tolerated.Review after 3 months.\\n\\nTo continue during and after oral antibiotic to prevent recurrence. get expert opinion if no improvement"
    },
    {
        "num": "120",
        "name": "Acne Duac",
        "line1": "Acne",
        "desc": "Clindamycin\/ Benzoyl peroxide 10 mg\/+ 50 mg\/ Gel (Duac)\\n\\nApply twice weekly to affected area to start and slowly increase frequency as tolerated. Once tolerated it can be applied every 24 hours. Review and limit use to 3 months if no improvement get expert opinion"
    },
    {
        "num": "182",
        "name": "Acnecide\/Benzoyl peroxide Acne",
        "line1": "Acnecide\/Benzoyl peroxide",
        "desc": "Acnecide\/Benzoyl peroxide 5%. Apply in a thin layer to the affected areas\u00a0 x 6\/12i if no improvement then get expert opinion plese"
    },
    {
        "num": "183",
        "name": "Adapalene 0.1% aqueous gel Topical Acne",
        "line1": "Adapalene 0.1% aqueous gel Topical",
        "desc": "Adapalene 0.1% aqueous gel. Apply thin film once daily at bedtime x 1\/12 and repeat x 6\/12 if no imprvement then get expert opinion please"
    },
    {
        "num": "113",
        "name": "Adapalene 0.1% w\/w cream or gel (Differin\u00ae)",
        "line1": "Adapalene 0.1% w\/w cream or gel (Differin)",
        "desc": "Adapalene 0.1% w\/w cream or gel (Differin)\\n\\nApply twice weekly to affected area to start and slowly increase frequency as tolerated. Review after 3 months. if no improvement then get dermatology opinion please"
    },
    {
        "num": "131",
        "name": "Almogran\u00a0(Almotriptan) Migraine",
        "line1": "Almogran\u00a0(Almotriptan)",
        "desc": "12.5mg.\u00a0P.O. O.D\/P.R.N. Dispense pack \\n\\nIf another attack occurs after the initial dose, a second dose maybe taken after 2 hour interval.\\n\\nIf there is no response to the initial dose DO NOT administer another dose."
    },
    {
        "num": "12",
        "name": "Almotriptan 12.5mg (Almogran)",
        "line1": "Almotriptan 12.5mg",
        "desc": "12.5mg \\n\\nOne to be taken at the onset of symptoms and repeat after 2 hours if second dose did not help then do not take 3rd dose"
    },
    {
        "num": "312",
        "name": "Alopecia Finasteride Hair loss",
        "line1": "Alopecia Finasteride",
        "desc": "Finasteride\u00a01\u00a0mg P.O.\u00a0O.D,\u00a0 \\n"
    },
    {
        "num": "167",
        "name": "Alphaderm cream topical Steroid",
        "line1": "Alphaderm cream topical Steroid",
        "desc": "B.D x 7\/7 Dispense 30g. Apply sparling to the affected area."
    },
    {
        "num": "196",
        "name": "Aluminium chloride hexahydrate 20%",
        "line1": "Aluminium chloride hexahydrate 20%",
        "desc": "Aluminium chloride hexahydrate 20%\u00a0\u00a0 dispense 1 x 75mls\\n\\nApply at night to dry skin, wash off the following morning, initially apply daily then reduce frequency as condition improves do not shower immediately before use."
    },
    {
        "num": "42",
        "name": "Amitiza (Lubiprostone) for constipation",
        "line1": "Amitiza (Lubiprostone) for constipation",
        "desc": "Amitiza (Lubiprostone) 24 Microgram Soft Capsules\u00a0one capsule to be taken taken twice daily. x 1\/12"
    },
    {
        "num": "192",
        "name": "Amitriplyline",
        "line1": "Amitriplyline",
        "desc": "Amitriplyline Specify dose 10\/20\/30 mgs P.O nocte x 1\/12. Repeat x 6\/12.\\n"
    },
    {
        "num": "318",
        "name": "Amoxicillin Abx",
        "line1": "Amoxicillin Abx",
        "desc": "Amoxicillin 500mg to be taken orally three times a day for five\u00a0days"
    },
    {
        "num": "246",
        "name": "Amoxicillin Syrup 125mg\/5ml Paediatrics Abx",
        "line1": "Amoxicillin Syrup 125mg\/5ml Paediatrics Abx",
        "desc": "Amoxicillin Syrup 125mg\/5ml Specify dose T.I.D. x 5\/7"
    },
    {
        "num": "245",
        "name": "Amoxicillin Syrup 250mg\/5ml Paediatrics Abx",
        "line1": "Amoxicillin Syrup 250mg\/5ml Paediatrics Abx",
        "desc": "Amoxicillin Syrup 250mg\/5ml T.I.D. x 5\/7"
    },
    {
        "num": "108",
        "name": "Antimalarial (Malarone- Atovaquone\/Proguanil hydrochlorid)",
        "line1": "Antimalarial (Malarone- Atovaquone\/Proguanil hydrochlorid)",
        "desc": "250 mg\/100 mg film-coated tablets Atovaquone\/Proguanil hydrochloride  x14 day trip \\nDosage:\u00a0\\nOne tablet to be taken once a day, commencing two days prior to entering malaria area continuing during and for one week after leaving area\u00a0"
    },
    {
        "num": "185",
        "name": "Arcoxia NSAID Analgesia",
        "line1": "Arcoxia NSAID",
        "desc": "Specify dose 30mg and 60mgs\u00a01 tab with food daily x\u00a0 1\/12.\u00a0\\n\\n"
    },
    {
        "num": "186",
        "name": "Artelac single use eye drops",
        "line1": "Artelac single use eye drops",
        "desc": "Artelac single use drops. Insert 3-5 times daily as required. Keep in the fridge. Dispense 1 box and repeat x 1."
    },
    {
        "num": "266",
        "name": "Atorvastatin",
        "line1": "Atorvastatin",
        "desc": "SPECIFY STRENGTH\u00a020\/ 40\/ 80mg. P.O. O.D. x 1\/12 repeat 6\/12."
    },
    {
        "num": "268",
        "name": "Atovaquone (Malarone) Malaria Prophylaxis",
        "line1": "Atovaquone (Malarone) Malaria Prophylaxis",
        "desc": "Atovaquone (Malarone) 250mg tablets.1 tab P.O.O.D.\u00a0 X\u00a0(SPECIFY NO OF DAYS OF TREATMENT)\u00a0 tablets."
    },
    {
        "num": "293",
        "name": "Atrovent  Inhlaer",
        "line1": "Atrovent  Inhlaer",
        "desc": "20mcg \u00a01-2 puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "277",
        "name": "Avamys\u00a0Fluticasone Fuorate\u00a0Nasal Spray",
        "line1": "Avamys\u00a0Fluticasone Fuorate\u00a0Nasal Spray 27.5mcg",
        "desc": "2 sprays in each nostril once daily until symptoms are controlled and then reduce to one spray to each nostril mane as maintenance\u00a0for another week \\n"
    },
    {
        "num": "101",
        "name": "Azalia",
        "line1": "Azalia",
        "desc": "75 microgram film-coated tablets\u00a0\\n\\nTablets must be taken every day at about the same time so that the interval between two tablets always is 24 hours. The first tablet should be taken on the first day of menstrual bleeding. Thereafter one tablet each day is to be taken continuously, without taking any notice on possible bleeding. A new blister is started directly the day after the previous one. 1\/12 and repeat 6\/12"
    },
    {
        "num": "61",
        "name": "Azelaic acid 15% gel \u00a0(Skinoren\u00ae) Acne",
        "line1": "Azelaic acid 15% gel \u00a0(Skinoren)",
        "desc": "\u00a0 \u00a0Apply every 12 hours\u00a0one  after 3 months if no imprvement get dermatologist opinion please \\n"
    },
    {
        "num": "62",
        "name": "Azithromycin 250mg [ 8\u00a0Tablets ] Chlamydia",
        "line1": "Azithromycin 250mg [ 8\u00a0Tablets ]",
        "desc": "Take FOUR tablets at the same time as a single dose\u00a0on day one of treatment and then TWO tablets once a day for days two and three of treatment. Dispense 8 tablets"
    },
    {
        "num": "231",
        "name": "Azithromycin Abx chlamydia 2nd line treatment",
        "line1": "Azithromycin",
        "desc": "1g P.O stat. , followed by 500mg once daily for two days.\\n\\n"
    },
    {
        "num": "73",
        "name": "Azithromycin for Traveller's diarrhea",
        "line1": "Azithromycin",
        "desc": "1000mg STAT or 500mg PO OD for 3 days."
    },
    {
        "num": "86",
        "name": "Back or muscular pain",
        "line1": "Vimovo",
        "desc": "1. Vimovo Tabs. One P.O. B.D.  x 2\/52\\n2. (Difene) Diclofenac Sodium Spray Gel 4% TDS. Mitte 25g spray"
    },
    {
        "num": "49",
        "name": "Baclofen 10\/20mg spasm muscle relaxant",
        "line1": "Baclofen",
        "desc": "10mg Or 20mg three times a day for 5 days"
    },
    {
        "num": "55",
        "name": "Bactroban 2% w\/w Nasal Ointment",
        "line1": "Bactroban 2%",
        "desc": "\\n\\nA small amount of the ointment about the size of a match head is placed on the little finger and applied to the inside of each nostril. The nostrils are closed by pressing the sides of the nose together; this will spread the ointment throughout the nares. A cotton bud may be used instead of the little finger for the application in particular to infants or patients who are very ill.\\n5\/7"
    },
    {
        "num": "302",
        "name": "Beclazone Easi Breathe + Salbutamol Inhaler",
        "line1": "Beclazone Easi Breathe + Salbutamol Inhaler",
        "desc": "1. 100mcg\u00a02 puffs twice daily x 1\/12 can be use for 3 months and repeat the same dose if required \\n\\n\\n\\n2.)\u00a0Salbutamol  2puffs as require for short term"
    },
    {
        "num": "77",
        "name": "Beclazone Easibreath 200mcg and  Salbutamol",
        "line1": "Beclazone Easibreath 200mcg and  Salbutamol",
        "desc": "1.\u00a0\u00a0Beclazone Easibreath 200mcg\u00a0 1 puff B.D. 1\/12 and repeat 6\/12.\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS INHALER.\\n\\n2.\u00a0\u00a0Salbutamol\/Ventolin\u00a0Inhaler. 100mcg\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "58",
        "name": "Beconase Aqueous Nasal Spray (Beclometasone Dipropionate",
        "line1": "Beconase Aqueous Nasal Spray (Beclometasone Dipropionate",
        "desc": "Beconase Aqueous Nasal Spray (Beclometasone Dipropionate 50\u03bcg (as monohydrate, micronised)\u00a02 sprays to each nostril mane x 2\/52\u00a0and then when symptoms are controlled,\u00a0reduce to 1 spray each nostril mane as maintenance.\u00a0x 1\/12 and repeat x 6\/12.\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS NASAL SPRAY.\u00a0"
    },
    {
        "num": "130",
        "name": "Beconase nsasal spray",
        "line1": "Beconase nsasal spray",
        "desc": "Beconase nsasal spray 100mcg. 2 sprays in each nostril\u00a0 twice daily x\u00a014 days. Once symptoms are under control one spray on each nostril twice daily. Repeat x 1\/12"
    },
    {
        "num": "194",
        "name": "Betacap Scalp Application Topical Steroids",
        "line1": "Betacap Scalp Application Topical Steroids",
        "desc": "Betacap Scalp Application B.D. for one week and then reduce to night for the second week and then reduce to\u00a0alternate night for the third week and then stop."
    },
    {
        "num": "193",
        "name": "Betnesol  steroids rinse",
        "line1": "Betnesol  steroids rinse",
        "desc": "Betnesol 500mcg\u00a0tablets Q.I.D, \u00a0Dissolve 1 in 10 mls of warm water and gargle Dispense 30 tabs. Do not swallow Repeat x 5"
    },
    {
        "num": "214",
        "name": "Betnesol N Ear Drops Steroid",
        "line1": "Betnesol N Ear Drops Steroid",
        "desc": "Betnesol N Ear Drops: 2-3 drops into the affected ear(s) T.I.D x 1\/52"
    },
    {
        "num": "177",
        "name": "Betnesol Nasal drops Steroids",
        "line1": "Betnesol Nasal drops Steroids",
        "desc": "Betnesol Nasal drops. 2-3 drops in each nostril B.D x 1\/52\\n\\n"
    },
    {
        "num": "252",
        "name": "Betnovate ointment Topical Steroid",
        "line1": "Betnovate ointment Topical Steroid",
        "desc": "Betnovate ointment.\u00a0x 1\\n"
    },
    {
        "num": "204",
        "name": "Betnovate Scalp Application Topical Steroid",
        "line1": "Betnovate Scalp Application Topical Steroid",
        "desc": "Betnovate Scalp Application 0.1% x 100mls. x 1 and repeat x 1\\n\\nApply sparingly, weekly when maintenance is required"
    },
    {
        "num": "296",
        "name": "Bricanyl Turbohaler Inhaler",
        "line1": "Bricanyl Turbohaler Inhaler",
        "desc": "Bricanyl Turbohaler\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "2",
        "name": "Bricanyl\u00ae Turbohaler\u00ae",
        "line1": "Bricanyl Turbohaler",
        "desc": "500micrograms per metered dose, inhalation powder (terbutaline sulphate)\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "87",
        "name": "Candida balanitis (Male thrush-yeast infection)",
        "line1": "Candida balanitis (Male thrush-yeast infection)",
        "desc": "Cloritomazole 1% cream\\n\\nApply twice daily topically for 5-7 days. Oral treatment is rarely indicated."
    },
    {
        "num": "222",
        "name": "Canesten Cream Antifungal Topical",
        "line1": "Canesten Cream Antifungal Topical",
        "desc": "Canesten (Clotrimazole) Cream 2%.\u00a0 T.I.D. x 1\/52\u00a0then reduce to B.I.D. until symptoms settle and\u00a0then Nocte x 2\/52 and then alternate nights x 2\/52\u00a0and then stop if symptoms are settled."
    },
    {
        "num": "221",
        "name": "Canesten Pessary Antifungal Thrush",
        "line1": "Canesten Pessary Antifungal Thrush",
        "desc": "Canesten 200mg Pessary. Insert one pessary daily, Nocte, x 3\/7.\u00a0 Dispense 3 pessaries"
    },
    {
        "num": "224",
        "name": "Canesten-HC\u00a0Cream Topical Antifungal",
        "line1": "Canesten-HC\u00a0Cream Topical Antifungal",
        "desc": "Canesten-HC\u00a0Cream T.I.D. x 1\/52\u00a0then reduce to B.I.D. x 1\/52 and then nocte x 1\/52 and then alternate nights x 1\/52\u00a0and then stop. Apply sparingly to the affected areas and avoid prolonged continuous use."
    },
    {
        "num": "234",
        "name": "Cefalexin  Abx",
        "line1": "Cefalexin  Abx",
        "desc": "Cefalexin 500mg P.O. T.I.D. x 1\/52\\n"
    },
    {
        "num": "233",
        "name": "Cefalexin 125\/5ml Paediatric Abx",
        "line1": "Cefalexin 125\/5ml Paediatric Abx",
        "desc": "Cefalexin 125\/5ml. 5ml P.O. T.I.D.\u00a0 x 1\/52\\n\\n"
    },
    {
        "num": "232",
        "name": "Cefalexin 250\/5ml Paediatric Abx",
        "line1": "Cefalexin 250\/5ml Paediatric Abx",
        "desc": "5ml suspension. 5ml P.O. T.I.D.\u00a0 x 1\/52\\n\\n"
    },
    {
        "num": "338",
        "name": "Cerazette tablets [ 168 Tablets ]",
        "line1": "Cerazette tablets [ 168 Tablets ]",
        "desc": "CERAZETTE\\nCerazette tablets [ 168 Tablets ]\\n\\nDirections to use\u00a0: Take one tablet daily, at the same time every day."
    },
    {
        "num": "330",
        "name": "CHAMPIX smoking cessation",
        "line1": "CHAMPIX smoking cessation",
        "desc": "CHAMPIX\\nFor further instructions please read the leaflet"
    },
    {
        "num": "213",
        "name": "Chloramphenicol 0.5% eye drops Abx",
        "line1": "Chloramphenicol 0.5% eye drops",
        "desc": "2 drops into the affected\u00a0eye(s) Q.I.D.\u00a0Continue for 48 hours after the symptoms have resolved."
    },
    {
        "num": "212",
        "name": "Chloramphenicol 1% ointment eye Abx",
        "line1": "Chloramphenicol 1% ointment eye Abx",
        "desc": "1 application of ointment into the affected\u00a0eye(s) Q.I.D. Continue for 48 hours after the symptoms have resolved."
    },
    {
        "num": "35",
        "name": "Chloromycetin 0.5% Redidrops ear drops\u00a0(can be used for less than 2 years)",
        "line1": "Chloromycetin 0.5% Redidrops ear drops\u00a0(can be used for less than 2 years)",
        "desc": "Chloromycetin 0.5% Redidrops\u00a02 drops into the affected\u00a0ear(s) Q.I.D.\u00a0Continue for 48 hours after the symptoms have resolved."
    },
    {
        "num": "198",
        "name": "Chlorphenamine  syrup Paediatrics Antihistamine",
        "line1": "Chlorphenamine  syrup Paediatrics Antihistamine",
        "desc": "Chlorphenamine maleate 2mg\/5mL Syrup\u00a0\u00a02.5mls nocte (150mls) \u00a0 \u00a0 \u00a0 \u00a0\\n\\nChild 1\u201323 months\\n\\n1\u00a0mg twice daily.\\n\\nChild 2\u20135 years\\n\\n1\u00a0mg every 4\u20136\u00a0hours; maximum 6\u00a0mg per day.\\n\\nChild 6\u201311 years\\n\\n2\u00a0mg every 4\u20136\u00a0hours; maximum 12\u00a0mg per day.\\n\\nChild 12\u201317 years\\n\\n4\u00a0mg every 4\u20136\u00a0hours; maximum 24\u00a0mg per day."
    },
    {
        "num": "334",
        "name": "CIALIS 2.5\/5\/10\/20mg ED",
        "line1": "CIALIS 2.5\/5\/10\/20mg ED",
        "desc": "Cialis (Tadalafil) DOSE mg 4 tablets x 6 [ 24 (maximum) tablets]\\n1 tablet P.O. 30 minutes before sexual activity to max 1 tablet in any 36 hours.\\nFor further instructions please read the leaflet"
    },
    {
        "num": "4",
        "name": "Cilest",
        "line1": "Cilest 250\/35microgram Tablets (norgestimate, ethinylestradiol)\\n",
        "desc": "\\nThe tablets must be taken every day at about the same time, if necessary with a little liquid, in the order shown on the blister pack. One tablet is to be taken daily for 21 consecutive days. Every subsequent blister pack is started after a 7-day tablet-free interval\u00a0 during which time a withdrawal bleeding usually occurs.\u00a0 Mitte\u00a0x 1\/12\u00a0& Repeat for 6\/12.\\nFurther instructions are in your Patient Record."
    },
    {
        "num": "346",
        "name": "Cilique tablets 6 months supply [ 126 Tablets ]",
        "line1": "Cilique tablets 6 months supply [ 126 Tablets ]",
        "desc": "CILIQUE\\nCilique tablets 6 months supply [ 126 Tablets ]\\n\\nDirections to use : One tablet daily for 21 days."
    },
    {
        "num": "138",
        "name": "Cimetidine\u00a0Antacid",
        "line1": "Cimetidine\u00a0Antacid",
        "desc": "Cimetidine 400 mg 1 tablet P. O B.D. Dispense * 56 tablets"
    },
    {
        "num": "243",
        "name": "Ciprofloxacin\u00a0Abx",
        "line1": "Ciprofloxacin\u00a0",
        "desc": "Specify 250mg or 500mg P.O.B.D. Dispense 14 tabs."
    },
    {
        "num": "82",
        "name": "Clarithromycin",
        "line1": "Clarithromycin",
        "desc": "Clarithromycin 500mg. P.O. B.D. x 5\/7 or 7days"
    },
    {
        "num": "127",
        "name": "Clarithromycin 125mg\/5mls Paediatric Abx",
        "line1": "Clarithromycin 125mg\/5mls Paediatric Abx",
        "desc": "Oral Solution\u00a0125mg\/5mls B.D x 5\/7\\n"
    },
    {
        "num": "126",
        "name": "Clarithromycin 250mg\/5mls Paediatric Abx",
        "line1": "Clarithromycin 250mg\/5mls",
        "desc": "Oral Solution\u00a0250mg\/5mls P.O, B.D x 5\/7\\n\\n"
    },
    {
        "num": "72",
        "name": "Clindamycin 2% cream",
        "line1": "Clindamycin 2% cream",
        "desc": "2% cream 5g applicatorful inserted intravaginally at night for 7 nights\\n\\nAvoid clindamycin cream in first trimester.\\n\\nClindamycin cream can weaken latex condoms\/diaphragms, which should not be used during treatment and for 72 hours afterwards."
    },
    {
        "num": "22",
        "name": "Clindamycin 2% cream OR 5g applicatorful inserted intravaginally  for bacterial vaginosis",
        "line1": "Clindamycin 2% cream OR 5g applicatorful inserted intravaginally  for bacterial vaginosis",
        "desc": "2% cream OR 5g applicatorful inserted intravaginally at night 7 nights Avoid clindamycin cream in first trimester. Clindamycin cream can weaken latex condoms\/diaphragms, which should not be used during treatment and for 72 hours afterwards.\\n"
    },
    {
        "num": "23",
        "name": "Clindamycin capsules 300mg for bacterial vaginosis",
        "line1": "Clindamycin capsules",
        "desc": "300mg orally every 12 hours 7 days\\n"
    },
    {
        "num": "238",
        "name": "Clindamycin Cream Abx PV",
        "line1": "Clindamycin Cream",
        "desc": "One applicator full\u00a0P.V. nocte x 1\/52.\\n\\n"
    },
    {
        "num": "258",
        "name": "Clobetasol (Dermovate) ointment Topical Steroid",
        "line1": "Clobetasol (Dermovate) ointment Topical",
        "desc": "0.05% ointment x 30g\u00a0\\n\\nApply\u00a0sparingly\u00a0to the affected area B.D. x1\/52 and then reduce to\u00a0 nocte x1\/52 and then alternate nocte x\/152 and then stop.\\n\\nAvoid prolonged daily use of this ointment."
    },
    {
        "num": "92",
        "name": "Cloritomazole 1% cream OTC (Vulvovaginal candidiasis or Vaginal thrush)",
        "line1": "Cloritomazole 1% cream OTC",
        "desc": "\\n\\nApply to the affected area 2-3 times a day, until the symptoms resolved. Up to 7 days. Should be continued for external relief of symptoms in addition to intravaginal or systemic antifungal if required.\u00a0"
    },
    {
        "num": "93",
        "name": "Cloritomazole 2% cream OTC (Vulvovaginal candidiasis or Vaginal thrush)",
        "line1": "Cloritomazole 2% cream OTC",
        "desc": "\\n\\nApply to the affected area 2-3 times a day, until the symptoms resolved. Up to 7 days. Should be continued for external relief of symptoms in addition to intravaginal or systemic antifungal if required.\u00a0"
    },
    {
        "num": "94",
        "name": "Cloritomazole 500mg pessary OTC (Vulvovaginal candidiasis or Vaginal thrush)",
        "line1": "Cloritomazole",
        "desc": "(Canestan) 500mg pessary Single dose\\n\\nInsert the pessary using applicator. Use of an applicator is not recommended during pregnancy. Latex condoms and diaphragms ca be damaged by vaginal creams and pessaries, extra precautions are advised."
    },
    {
        "num": "121",
        "name": "Co-amoxiclav\u00a0 Abx",
        "line1": "Co-amoxiclav\u00a0",
        "desc": "\u00a0500\/125mg. P.O. T.I.D x\u00a05\/7 or 7days"
    },
    {
        "num": "125",
        "name": "Co-amoxiclav\u00a0125\/31.25 mg Paediatrics Abx",
        "line1": "Co-amoxiclav\u00a0125\/31.25 mg Paediatrics",
        "desc": "\u00a0125\/31.25mg in 5mL Oral Suspension SPECIFY DOSET.I.D. x 5\/7"
    },
    {
        "num": "203",
        "name": "Codinex Syrup cough",
        "line1": "Codinex Syrup",
        "desc": "5-7.5 mls P.O Q.I.D \/P.R.N X 5 days. Dispense 100\/150mls\\n\\n"
    },
    {
        "num": "34",
        "name": "Colchicine  for acute gout attack",
        "line1": "Colchicine",
        "desc": "500 microgram 1 tablet to be taken orally 3 times a day for 5 days"
    },
    {
        "num": "143",
        "name": "Colchicine Gout",
        "line1": "Colchicine",
        "desc": "Colchicine 500 microgram Tablet.\u00a0Dispense 12 tablets.\\n\\nUse as directed by your doctor."
    },
    {
        "num": "161",
        "name": "Colecalciferol Vitamin D",
        "line1": "Colecalciferol Vitamin D",
        "desc": "Colecalciferol 20,000 IU One capsule orally, twice per week x 7\/52.\\n"
    },
    {
        "num": "169",
        "name": "Colofac Mebeverine hydrochloride IBS",
        "line1": "Colofac Mebeverine hydrochloride",
        "desc": "tabs. P.O T.I.D, 1 tab to be taken 20 minutes before eating food. Dispense 90 tabs."
    },
    {
        "num": "158",
        "name": "Corsodyl 0.2 % w\/v Aniseed Mouthwash.",
        "line1": "Corsodyl 0.2 % w\/v Aniseed Mouthwash.",
        "desc": "\u00a010mls B.D Dispense 300mls bottle.\\n\\nRinse mouth for 1 minute and spit out after use. Avoid prolonged use."
    },
    {
        "num": "50",
        "name": "Cough syrup Bisolvon 4mg\/5ml Oral Solution (Children 2 to \u2264 5 years)",
        "line1": "Cough syrup Bisolvon 4mg\/5ml Oral Solution (Children 2 to \u2264 5 years)",
        "desc": "Bisolvon 4mg\/5ml Oral Solution\\n\\n5 ml (4 mg) twice daily."
    },
    {
        "num": "51",
        "name": "Cough syrup Bisolvon 4mg\/5ml Oral Solution (Children over 5 to \u2264 12 years)",
        "line1": "Cough syrup Bisolvon 4mg\/5ml Oral Solution (Children over 5 to \u2264 12 years)",
        "desc": "Bisolvon 4mg\/5ml Oral Solution\u00a0\\n\\n5 ml (4 mg) four times daily"
    },
    {
        "num": "52",
        "name": "Cough syrup Bisolvon 4mg\/5ml Oral Solution for adults",
        "line1": "Cough syrup Bisolvon 4mg\/5ml Oral Solution for adults",
        "desc": "Bisolvon 4mg\/5ml Oral Solution\\n\\n10 ml (8 mg) three times daily, maximum dose 15 ml (12 mg) four times daily"
    },
    {
        "num": "247",
        "name": "Crestor Rosuvastatin",
        "line1": "Crestor Rosuvastatin",
        "desc": "Specify 5\/10\/20 mg P.O.O.D. x 1\/12 repeat 6\/12"
    },
    {
        "num": "146",
        "name": "Crotamiton 10% w\/w (Eurax) cream Topical Itch",
        "line1": "Crotamiton 10% w\/w (Eurax) cream Topical Itch",
        "desc": "Crotamiton 10% w\/w (Eurax) cream. Apply twice per day to affected areas. Dispense 100g."
    },
    {
        "num": "43",
        "name": "Cyklokapron 500 mg (Tranexamic acid) for Menorrhagia",
        "line1": "Cyklokapron 500 mg (Tranexamic acid) for Menorrhagia",
        "desc": "Cyklokapron 500 mg\u00a02 tablets\u00a03\u00a0times daily for 1\/52"
    },
    {
        "num": "71",
        "name": "Daktacort 2% \/ 1% w\/w Cream",
        "line1": "Daktacort 2% \/ 1% w\/w Cream",
        "desc": "Daktacort 2% \/ 1% w\/w Cream (Miconazole nitrate 2%w\/w and hydrocortisone 1%w\/w)\\n\\nApply one to three times daily to the affected area. Daktacort cream should be rubbed in gently until it has been completely penetrated into the skin. The treatment with Daktacort cream (or subsequently with miconazole nitrate 20 mg\/g cream) should be continued without interruption until the lesion has completely disappeared (usually after 2 to 6 weeks)\\n"
    },
    {
        "num": "225",
        "name": "Daktacort Cream Topical Antifungal",
        "line1": "Daktacort Cream topical",
        "desc": "T.I.D. x 3\/7 then reduce to B.I.D. x 1\/52\u00a0and then nocte x 1\/52.\u00a0\\n\\nApply sparingly to the affected areas Avoid prolonged continuous use of this ointment."
    },
    {
        "num": "220",
        "name": "Daktarin Cream Topical Antifungal",
        "line1": "Daktarin Cream Topical",
        "desc": "T.I.D. x 1\/52\u00a0then reduce to B.I.D. until symptoms settle and\u00a0then Nocte x 2\/52 and then alternate nights x 2\/52\u00a0and then stop if symptoms are settled."
    },
    {
        "num": "201",
        "name": "Dalacin T Solution\/lotion clindamycin Abx Acne",
        "line1": "Dalacin T Solution\/lotion clindamycin Abx Acne",
        "desc": "Dalacin T Solution\/lotion B.D. to the affected area. x 1\/12 and repeat x\u00a0 6\/12."
    },
    {
        "num": "271",
        "name": "DAPOXETINE  Premature ejaculation",
        "line1": "DAPOXETINE",
        "desc": "30 mg \u00a0Dispense 1 box x 6 tablets. Repeat x 5 times.\\n\\n1 tablet 1-3 hours prior to sexual activity to maximum of 1 tablet in 24 hours. Take with plenty of water. Avoid drinking alcohol when using this medicine."
    },
    {
        "num": "114",
        "name": "Depression and insomnia- Mirtazapine",
        "line1": "Depression and insomnia-",
        "desc": "Mirtazapine 15mg to be taken once a day in the night 1\/12 and repeat for 3\/12"
    },
    {
        "num": "139",
        "name": "Deslor Paediatric Antihistamine",
        "line1": "Deslor Paediatric",
        "desc": "0.5 mg\/ml Oral Solution (Desloratidine)\u00a0Dispense 100mls\\n\\nDosage:\\n\\n1-5yrs\u00a02.5 ml (1.25 mg) Deslor oral solution once a day\\n6-11yrs 5 ml (2.5 mg) Deslor oral solution once a day\\n12yrs and above\u00a0\u00a010 ml (5 mg) oral solution once a day"
    },
    {
        "num": "265",
        "name": "Desloratidine\u00a0Antihistamine",
        "line1": "Desloratidine\u00a0",
        "desc": "\u00a05mg P.O. O.D. x 1\/12 repeat 6\/1\\n"
    },
    {
        "num": "342",
        "name": "Dianette tablets [ 126 Tablets ] for Acne",
        "line1": "Dianette tablets",
        "desc": "\\n\\nDirections to use : One tablet daily for 21 days."
    },
    {
        "num": "209",
        "name": "Diclofenac + PPI NSAID Analgesia",
        "line1": "Diclofenac + PPI NSAID Analgesia",
        "desc": "Diclofenac 50mg P.O. T.I.D. x 1\/52 and repeat x 3 times.\\n\\nEsomeprazole 20mg P.O O.D x 1\/52 and repeat x 3 times."
    },
    {
        "num": "273",
        "name": "Diclofenac retard NSAID Analgesia",
        "line1": "Diclofenac retard NSAID Analgesia",
        "desc": "Diclofenac retard. 75mg P.O. B.D x 1\/52 repeat x 4"
    },
    {
        "num": "137",
        "name": "Diclofenac Sodium Spray Topical NSAID Analgesia",
        "line1": "Diclofenac Sodium Spray Topical NSAID Analgesia",
        "desc": "Diclofenac Sodium Spray Gel 4%\u00a0 T.I.D\/P.R.N. Dispense 25g spray. Repeat x 3"
    },
    {
        "num": "325",
        "name": "Diflucan (Fluconazole) antifungal Thrush",
        "line1": "Diflucan (Fluconazole)",
        "desc": "150mg caps. One P.O. at onset of symptoms. If not settled after 72 hours, repeat x once. Mitte O.P.x 1 and repeat x once P.R.N.\\n\\nFor further instructions please read the leaflet"
    },
    {
        "num": "152",
        "name": "Diphenhydramine Hydrochloride Antihistamine",
        "line1": "Diphenhydramine Hydrochloride",
        "desc": "50mg tablets. 1\/2 or 1 full tablet,\u00a0one to two hours before bed. 16 tablets.\\n\\nNot recommended in the 2 weeks prior to delivery or for use in breastfeeding. Can cause dizziness and drowsiness - do not operate machinery or drive if affected"
    },
    {
        "num": "292",
        "name": "Distaclor L.A Abx",
        "line1": "Distaclor L.A Abx",
        "desc": "375mb P.O. B.D. x 1\/52.\u00a0"
    },
    {
        "num": "44",
        "name": "Distaclor LA 375 mg for recurrent tonsilitis",
        "line1": "Distaclor LA 375",
        "desc": "one tablet to be taken twice daily for 7 days."
    },
    {
        "num": "153",
        "name": "Doublebase emollient topical",
        "line1": "Doublebase emollient gel",
        "desc": "2-3 times daily,\u00a0 Dispense 500g. Repeat x 6\\n\\n"
    },
    {
        "num": "83",
        "name": "Dovobet - psoriasis",
        "line1": "Dovobet - psoriasis",
        "desc": "Dovobet\u00ae 50micrograms\/g+0.5mg\/g Gel (calcipotriol \/ betamethasone) - Use the gel once a day (Maximum 15gper day) for 4 weeks for scalp areas and 8 weeks for non-scalp areas.\u00a0\\n\\nApply Dovobet to the affected area with your fingertips, and rub it in gently until the area affected by psoriasis is covered by a thin layer of gel. Cutaneous use only."
    },
    {
        "num": "195",
        "name": "DOVOBET Gel Topical Steroid",
        "line1": "DOVOBET Gel Topical Steroid",
        "desc": "30g\u00a0betamethasone (as dipropionate) 0.05%,calcipotriol (as monohydrate) 50 micrograms\/g x 4\/52"
    },
    {
        "num": "180",
        "name": "Doxycycline 100mg Abx Acne",
        "line1": "Doxycycline 100mg",
        "desc": "100mg P.O O.D x 3\/12\\n\\nUse SPF and avoid strong sun exposure. Avoid pregnancy while using this medication. Take with a glass of water or food"
    },
    {
        "num": "230",
        "name": "Doxycycline Abx Chlamydia 1st line",
        "line1": "Doxycycline Abx Chlamydia 1st line",
        "desc": "\u00a0Doxycycline 100 mg B.D x7\/7\\n\\nAvoid in pregnancy and breastfeeding."
    },
    {
        "num": "21",
        "name": "Doxycycline and Ivermectin Rosacea",
        "line1": "Doxycycline and Ivermectin Rosacea",
        "desc": "Ivermectin 10mg\/g cream\u00a0(Soolantra\u00ae)\u00a0Apply thinly every 24 hours to the affected area at night 1\/12 and repeat 3\/12\\n\\nDoxycyline modified release\u00a040mg one tablet to be taken\u00a0every 24 hours \u00a0orally 1\/12 and repeat 3 months\\n\\nReview\u00a03 months"
    },
    {
        "num": "103",
        "name": "Doxycycline for Sinusitis\/RTI",
        "line1": "Doxycycline for Sinusitis\/RTI",
        "desc": "Doxycycline\u00a0200mg every 24 hours orally for 5 days\\n\\nAvoid in pregnancy. Advise to take with a glass of water and sit upright for 30 minutes after taking. Can take with food or milk if gastritis is an issue."
    },
    {
        "num": "250",
        "name": "Drynol\u00a0Bilastine Antihistamine",
        "line1": "Drynol\u00a0Bilastine Antihistamine",
        "desc": "Drynol (Bilastine) 20mg P.O. O.D. x 1\/12 repeat 6\/12"
    },
    {
        "num": "200",
        "name": "Duac Cream Abx Topical",
        "line1": "Duac Cream Abx Topical",
        "desc": "Duac Cream: Apply O.D. to the affected area. Repeat x 3\/12.\\n"
    },
    {
        "num": "184",
        "name": "Duloxetine  antidepressant",
        "line1": "Duloxetine  antidepressant",
        "desc": "Duloxetine 60mg P.O O.D x 1\/12\\n\\n"
    },
    {
        "num": "295",
        "name": "Duoresp Spiromax  Inhaler",
        "line1": "Duoresp Spiromax  Inhaler",
        "desc": "Duoresp Spiromax 160 mcg\/4.5 mcg. 2\u00a0puffs B.D. \u00a0x 1\/12 and repeat x 6\/12\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS INHALER."
    },
    {
        "num": "253",
        "name": "Dymista Nasal Spray Sinusitis",
        "line1": "Dymista Nasal Spray Sinusitis",
        "desc": "Dymista Nasal Spray: One spray to each Nostril twice daily until symptoms are controlled and then reduce to one spray to each nostril once daily x 1\/12. repeat 6\/12.\\n\\nGargle with water after using spray."
    },
    {
        "num": "20",
        "name": "E45 Cream",
        "line1": "E45 Cream",
        "desc": "E45 Cream White Soft Paraffin 14.5% w\/w Light Liquid Paraffin 12.6% w\/w Anhydrous Lanolin 1.0% w\/w\u00a0Apply topically to the affected part two or three times daily\u00a0"
    },
    {
        "num": "91",
        "name": "Econazole (Gyno-Pevaryl) pessary OTC for genital thrush",
        "line1": "Econazole (Gyno-Pevaryl) pessary OTC for genital thrush",
        "desc": "Econazole (Gyno-Pevaryl) pessary 150mg PV single dose\u00a0\\n\\nInsert pessary using applicator. Use of an applicator is not recommended during pregnancy. Latex condoms and diaphragms ca be damaged by vaginal creams and pessaries, extra precautions are advised."
    },
    {
        "num": "67",
        "name": "ellaOne 30mg",
        "line1": "ellaOne 30mg",
        "desc": "ellaOne 30mg Please dispense ONE tablet only.\\n\\nThe tablet should be taken as soon as possible after sexual intercourse.\u00a0\\n"
    },
    {
        "num": "219",
        "name": "Elocon Ointment Topical Steroid",
        "line1": "Elocon Ointment Topical Steroid",
        "desc": "Elocon Ointment nocte\u00a0x 10\/7\u00a0then reduce to alternate\u00a0nocte\u00a0x 10\/7\u00a0and then\u00a0stop. Apply sparingly to the affected areas and avoid prolonged continuous use."
    },
    {
        "num": "174",
        "name": "Eltroxin Levothyroxine",
        "line1": "Eltroxin Levothyroxine",
        "desc": "Eltroxin\/Levothyroxine Specify dose.\u00a0 P.O O.D. x 6\/12\u00a0\\n\\nTake in the morning, on an empty stomach and do not eat for 30 minutes."
    },
    {
        "num": "111",
        "name": "Elvina combined contraceptive pill",
        "line1": "Elvina combined contraceptive pill",
        "desc": "Elvina 0.03mg\/3mg (0.03 mg ethinylestradiol and 3 mg drospirenone.)\\n\\nThe tablets must be taken every day at about the same time, if necessary, with a little liquid, in the order shown on the blister pack. One tablet is to be taken daily for 21 consecutive days. Each subsequent pack is started after a 7-day tablet-free interval, during which time a withdrawal bleed usually occurs. This usually starts on day 2-3 after the last tablet and may not have finished before the next pack is started.\u00a0Miite 1\/12 and repeat 6\/12"
    },
    {
        "num": "256",
        "name": "Emla nNumbing Cream Topical",
        "line1": "Emla nNumbing Cream Topical",
        "desc": "Emla Cream 5% \\n\\nLeave in contact for 15 minutes then wash off prior to activity. 1 tube and repeat x 6."
    },
    {
        "num": "175",
        "name": "Epiduo Gel Topical Acne",
        "line1": "Epiduo Gel Topical Acne",
        "desc": "Epiduo Gel.\u00a0 Apply once daily on clean dry acne skin, in the evening. Do not apply to irritated\/damaged skin repeat x 6"
    },
    {
        "num": "69",
        "name": "Epilim (Valproate)",
        "line1": "Epilim (Valproate)",
        "desc": "Epilim Chrono 500mg PO OD x 1\/12 and repeat 6\/12"
    },
    {
        "num": "240",
        "name": "Erythromycin  Abx",
        "line1": "Erythromycin  Abx",
        "desc": "Erythromycin 500mg tabs. P.O. B.D. x 1\/52.\\n\\n"
    },
    {
        "num": "239",
        "name": "Erythromycin Paediatric Syrup Abx",
        "line1": "Erythromycin Paediatric Syrup Abx",
        "desc": "\u00a0Erythromycin\u00a0Syrup125mg\/5ml.\u00a0P.O. B.D x 1\/52\\n\\nSpecify dose on weight basis at 30mg\/kg weight of child."
    },
    {
        "num": "311",
        "name": "Escitalopram Antidepressant",
        "line1": "Escitalopram Antidepressant",
        "desc": "Escitalopram\u00a05 \/ 10\/ 20 mg\u00a0tabs One P.O. O.D. x 1\/12 and repeat x 3\/12.\\n"
    },
    {
        "num": "291",
        "name": "Esomeprazole PPI",
        "line1": "Esomeprazole PPI",
        "desc": "Esomeprazole\u00a020 \/\u00a040 mg\u00a0 P.O. O.D.\u00a0 x 1\/12 and repeat x 6\/12.\\n"
    },
    {
        "num": "164",
        "name": "Estrogel Pump Utrogestan tablets HRT",
        "line1": "Estrogel Pump Utrogestan tablets HRT",
        "desc": "Estrogel Pump [0.06% w\/w]\u00a0 1-2 pump daily x 1\/12. Repeat x 6\/12\\n\\nUtrogestan tablets 100mgs 1 daily PO x 1\/12 Repeat x 6\/12"
    },
    {
        "num": "150",
        "name": "Etoflam 5% Cream Topical NSAID Analgesia",
        "line1": "Etoflam 5% Cream Topical NSAID Analgesia",
        "desc": "Etoflam 5% Cream. T.I.D\/P.R.N x 1 tube. Massage well into affected area.\u00a0\\n\\n"
    },
    {
        "num": "27",
        "name": "Eumovate Cream 0.05% w\/w",
        "line1": "Eumovate Cream 0.05% w\/w",
        "desc": "Eumovate Cream 0.05% w\/w\u00a0Apply thinly and gently rub in using only enough to cover the entire affected area once or twice a day until improvement occurs, then reduce the frequency of application\\n\\nMitte x 4 weeks"
    },
    {
        "num": "275",
        "name": "Eumovate Ointement Topical Steroid",
        "line1": "Eumovate Ointement Topical Steroid",
        "desc": "Eumovate Ointement. Apply sparingly to the affected areas T.I.D. x 1\/52\u00a0then reduce to B.I.D. x 1\/52,\u00a0and then Nocte x 1\/52 and then alternate nights x 1\/52\u00a0and then stop.\u00a0Avoid prolonged continuous use of this ointment."
    },
    {
        "num": "347",
        "name": "Evra (patches) [ 18 Patches ]",
        "line1": "Evra (patches) [ 18 Patches ]",
        "desc": "EVRA (PATCHES)\\nEvra (patches) [ 18 Patches ]\\n\\nDirections to use : Apply first patch on day 1 of cycle, change patch on days 8 and 15; remove third patch on day 22 and apply new patch after 7-day patch-free interval to start subsequent contraceptive cycle"
    },
    {
        "num": "211",
        "name": "Exocin Ofloxacin Opthalmic\u00a0Drops Abx",
        "line1": "Exocin Ofloxacin Opthalmic\u00a0Drops Abx",
        "desc": "Exocin (Ofloxacin) Opthalmic\u00a0Drops. 1-2 drops into the affected eye(s) up to Q.I.D. .\u00a0Continue for 48 hours after the symptoms have resolved, maximum of 10 days treatment."
    },
    {
        "num": "15",
        "name": "EXOCIN: ofloxacin 0.3% w\/v eye drops",
        "line1": "EXOCIN: ofloxacin 0.3% w\/v eye drops",
        "desc": "EXOCIN: ofloxacin 0.3% w\/v eye drops,\\n\\n2 drops into the affected\u00a0eye(s) Q.I.D. Continue for 48 hours after the symptoms have resolved."
    },
    {
        "num": "236",
        "name": "Famciclovir Antiviral",
        "line1": "Famciclovir Antiviral",
        "desc": "Famciclovir 500mg One P.O. T.I.D.\u00a0 Dispense x 21 tabs.\u00a0\\n\\n"
    },
    {
        "num": "142",
        "name": "Femoston-conti  HRT",
        "line1": "Femoston-conti  HRT",
        "desc": "Femoston-conti 1mg\/ 5mg film-coated tablets. P.O O.D, Dispense 28 tablets. Repeat x 6"
    },
    {
        "num": "199",
        "name": "Fesoterodine Antihistamine",
        "line1": "Fesoterodine Antihistamine",
        "desc": "Fesoterodine (Toviaz) 4mg \u00a0P.O. O.D. x 1\/12 and repeat x 1\/12.\\n\\n"
    },
    {
        "num": "65",
        "name": "Finasteride\u00a01\u00a0mg",
        "line1": "Finasteride\u00a01\u00a0mg",
        "desc": "Finasteride 1 mg P.O. O.D, Dispense 184 tabs"
    },
    {
        "num": "66",
        "name": "Finasteride\u00a05mg\u00a0tablets",
        "line1": "Finasteride\u00a05mg\u00a0tablets",
        "desc": "1. Finasteride\u00a05mg\u00a0tablets.\u00a0 1\/4 (one quarter)\u00a0of one tablet (1.25mg)\u00a0to be taken daily.\u00a0 \u00a0Dispense x 46 tablets to provide 184 days supply.\u00a0PLEASE ISSUE ALL 46 TABLETS TOGETHER.\u00a0\\n\\n2. Please offer to supply\u00a0a\u00a0pill cutter.\u00a0"
    },
    {
        "num": "119",
        "name": "Flagyl (Metronidazole) 400mg tabs.- Bacterial vaginosis",
        "line1": "Flagyl (Metronidazole) 400mg tabs.- Bacterial vaginosis",
        "desc": "Flagyl (Metronidazole) 400mg tabs. One P.O. B.D. for 1 week.\\n\\nAvoid taking alcohol when using this medicine and for 72 hours after. Mitte x 14 tabs."
    },
    {
        "num": "303",
        "name": "Flixotide  + Ventolin inhaler",
        "line1": "Flixotide  + Ventolin inhaler",
        "desc": "1. Flixotide 50 mcg Discus inhaler:\u00a01 puffs B.D.\u00a0x 1\/12 and repeat x 6\/12\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS INHALER.\\n\\n\\n2. Salbutamol\/Ventolin Inhaler. 100mcg\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "78",
        "name": "Flixotide Evohaler 125mcg and Ventollin",
        "line1": "Flixotide Evohaler 125mcg and Ventollin",
        "desc": "1.\u00a0\u00a0Flixotide Evohaler 125mcg\u00a01 puff B.D. 1\/12 and repeat 6\/12.\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS INHALER.\\n\\n2.\u00a0\u00a0Salbutamol\/Ventolin\u00a0Inhaler. 100mcg\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "124",
        "name": "Flucloxacillin 125mg\/5ml Paediatrics Abx",
        "line1": "Flucloxacillin 125mg\/5ml Paediatrics Abx",
        "desc": "Flucloxacillin powder for oral suspension\u00a0125mg\/5ml SPECIFY DOSE\u00a0Q.I.D x 7\/7"
    },
    {
        "num": "123",
        "name": "Flucloxacillin 250mg\/5ml Paediatrics Abx",
        "line1": "Flucloxacillin 250mg\/5ml Paediatrics Abx",
        "desc": "Flucloxacillin powder for oral suspension\u00a0250mg\/5ml SPECIFY DOSE\u00a0Q.I.D x 7\/7"
    },
    {
        "num": "323",
        "name": "Flucloxacllin Abx",
        "line1": "Flucloxacllin Abx",
        "desc": "Flucloxacillin 500mg P.O Q.I.D x 7\/7"
    },
    {
        "num": "317",
        "name": "Fluoxetine 20mg antidepressant",
        "line1": "Fluoxetine 20mg antidepressant",
        "desc": "Fluoxetine 20mg capsules. One capsule daily. Mitte x 1\/12 and repeat 3\/12\\n\\nSeek a review with your GP if you feel your mental health is getting worse"
    },
    {
        "num": "210",
        "name": "Fosfomycin Abx UTI",
        "line1": "Fosfomycin Abx UTI",
        "desc": "Fosfomycin 3g O.D stat. x 1\/7"
    },
    {
        "num": "99",
        "name": "Freedo",
        "line1": "Freedo",
        "desc": "Freedo (0.03 mg of ethinylestradiol and 3 mg of drospirenone)\u00a0film-coated tablets\\n\\nThe tablets must be taken every day at about the same time, if necessary with a little liquid, in the order shown on the blister pack. One tablet is to be taken daily for 21 consecutive days. Every subsequent blister pack is started after a 7-day tablet-free interval\u00a0 during which time a withdrawal bleeding usually occurs.\u00a0 Mitte\u00a0x 1\/12\u00a0& Repeat for 6\/12."
    },
    {
        "num": "104",
        "name": "Freedonel",
        "line1": "Freedonel",
        "desc": "Freedonel (0.02 mg ethinylestradiol \/\u00a03 mg drospirenone)\u00a0film-coated tablets\u00a0\\n\\nThe tablets must be taken every day at about the same time, if necessary with a little liquid, in the order shown on the blister pack. One tablet is to be taken daily for 21 consecutive days. Every subsequent blister pack is started after a 7-day tablet-free interval\u00a0 during which time a withdrawal bleeding usually occurs.\u00a0 Mitte\u00a0x 1\/12\u00a0& Repeat for 6\/12.\\n"
    },
    {
        "num": "133",
        "name": "Frovex\u00a0(Frovatriptan)\u00a0 Migraine",
        "line1": "Frovex\u00a0(Frovatriptan)\u00a0 Migraine",
        "desc": "Frovex\u00a0(Frovatriptan)\u00a02.5mg. P.O. O.D\/P.R.N. Dispense pack of 6 and repeat x 6\/12\\n\\nDo not exceed more than 5mg in any 24 hour period. If another attack occurs after the initial dose another tablet maybe taken after 2 hour interval. If there is no response to the initial dose DO NOT administer another dose"
    },
    {
        "num": "202",
        "name": "Fucibet lipid Topical Fusidic acid 2% and Betamethasone 0.1%",
        "line1": "Fucibet lipid Topical Fusidic acid 2% and Betamethasone 0.1%",
        "desc": "Fucibet lipid apply sparingly to affected area 1x1\/52."
    },
    {
        "num": "284",
        "name": "Fucidin 20mg\/g Topical",
        "line1": "Fucidin 20mg\/g Topical",
        "desc": "Fucidin 20mg\/g Cream\/Ointment Q.I.D to affected area Dispense *15g"
    },
    {
        "num": "285",
        "name": "Fucidin H cream\u00a0Topical",
        "line1": "Fucidin H cream\u00a0Topical",
        "desc": "Fucidin H cream.\u00a0Apply to the affected area every 8 hours for five days, then reduce to twice a day for the next five days and then reduce to nocte for the final five days and then stop.\u00a0To be applied sparingly.\u00a0Mitte x 15g."
    },
    {
        "num": "286",
        "name": "Fucidin Ointment Topical",
        "line1": "Fucidin Ointment Topical",
        "desc": "Fucidin Ointment\u00a0Apply Q.I.D. to the affected area. O.P. x 1.\u00a0Wash your hands after using this ointment."
    },
    {
        "num": "36",
        "name": "Fucithalmic 10mg\/g Viscous Eye Drops - Fuscidic acid",
        "line1": "Fucithalmic 10mg\/g Viscous Eye Drops - Fuscidic acid",
        "desc": "Fucithalmic 10mg\/g Viscous Eye Drops, suspension\u00a0One drop of Fucithalmic viscous eye drop, should be applied to the conjunctival sac every 12 hours. Treatment should be continued for 2 days after the eye appears normal."
    },
    {
        "num": "74",
        "name": "Fusidic acid 1% viscous eye drops suspension",
        "line1": "Fusidic acid 1% viscous eye drops suspension",
        "desc": "Fusidic acid 1% viscous eye drops suspension\u00a0\\n\\nApply one drop to the infected eye(s) every 12 hours.\u00a0Treatment should be continued for 48 hours after resolution of symptoms"
    },
    {
        "num": "310",
        "name": "Fusidic Acid eye drops Abx",
        "line1": "Fusidic Acid eye drops Abx",
        "desc": "Fusidic Acid opthalmic drops. instil one drop, B.D. Continue for 48 hours after the symptoms resolved."
    },
    {
        "num": "215",
        "name": "Gentisone HC Ear Drops Abx Steroid",
        "line1": "Gentisone HC Ear Drops Abx Steroid",
        "desc": "Gentisone HC Ear Drops 2-3\u00a0drops into the affected ear(s) T.I.D x 1\/52"
    },
    {
        "num": "168",
        "name": "Gyno Daktarin PV Antifungal",
        "line1": "Gyno Daktarin PV Antifungal",
        "desc": "Gyno Daktarin 20g\u00a0 P.V Nocte, x 7\/7"
    },
    {
        "num": "237",
        "name": "Gyno-Pevaryl Once Pessary  Econazole nitrate PV antifungal",
        "line1": "Gyno-Pevaryl Once Pessary  Econazole nitrate PV antifungal",
        "desc": "Gyno-Pevaryl Once Pessary O.P. x 1, repeat x1 P.R.N.\\n\\nInsert P.V. Nocte as directed. Repeat after 5 days if not symptoms are not resolved."
    },
    {
        "num": "313",
        "name": "Hair Loss - Finasteride 5mg",
        "line1": "Hair Loss - Finasteride 5mg",
        "desc": "Finasteride\u00a05mg\u00a0tablets. \u00a01\/4 (one quarter)\u00a0of one tablet (1.25mg)\u00a0to be taken daily.\u00a0\\n\\nDispense x 46 tablets to provide 184 days supply.\u00a0\\n\\nPLEASE ISSUE ALL 46 TABLETS TOGETHER.\u00a0\\n\\n\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\\nPlease offer to supply\u00a0a\u00a0pill cutter.\u00a0"
    },
    {
        "num": "37",
        "name": "HRT - Estradot 50 Patches \/ Utrogestan Capsules",
        "line1": "HRT - Estradot 50 Patches \/ Utrogestan Capsules",
        "desc": "Estradot\u00a0\u00a050\u00a0micrograms Transdermal Patch\u00a0One to be applied every 3 days Mitte x 1\/12. & Repeat x 6\/12.\\nUtrogestan\u00a0oral capsule\u00a0100 mg daily at night x 1\/12 and repeat 6\/12"
    },
    {
        "num": "100",
        "name": "HRT - Evorel Conti 50\/170 micrograms Transdermal Patch",
        "line1": "HRT - Evorel Conti 50\/170 micrograms Transdermal Patch",
        "desc": "Evorel Conti 50\/170 micrograms Transdermal Patch\u00a0One to be applied every 3 days Mitte x 1\/12. & Repeat x 6\/12."
    },
    {
        "num": "157",
        "name": "Humulin M3 (Mixture 3)",
        "line1": "Humulin M3 (Mixture 3)",
        "desc": "Humulin M3 (Mixture 3) 100 IU\/ml Suspension for Injection in cartridge. Take as directed by your doctor. Dispense 5 x 3ml cartridges. Repeat x 6"
    },
    {
        "num": "28",
        "name": "Hydrocortisone 1 % w\/w Cream",
        "line1": "Hydrocortisone 1 % w\/w Cream",
        "desc": "Hydrocortisone 1 % w\/w Cream to be applied topically\\n\\nRecommended dosage schedules:\\n\\nAdults: Use sparingly over a small area once or twice daily for a maximum period of one week.\\n\\nChildren: Hydrocortisone 1 % w\/w Cream is not recommended for use in children under 12 years without medical supervision"
    },
    {
        "num": "287",
        "name": "Hydrocortisone 1%\u00a0Cream. Topical Steroid",
        "line1": "Hydrocortisone 1%\u00a0Cream. Topical Steroid",
        "desc": "Hydrocortisone 1%\u00a0Cream. Apply\u00a0sparingly\u00a0to the affected areas B.I.D. x 1\/52 maximum.\u00a0\u00a0Dispense 15g.\\n\\nUse on the face only if specifically advised to by your doctor. Wash hands after use."
    },
    {
        "num": "288",
        "name": "Hydrocortisone Steroid",
        "line1": "Hydrocortisone Steroid",
        "desc": "Hydrocortisone Buccal 2.5mg, Apply one tab to the affected area Q.I.D. Dispense x 20\u00a0tabs."
    },
    {
        "num": "207",
        "name": "Imigran Migraine",
        "line1": "Imigran Migraine",
        "desc": "Imigran FTAB 50\/100mg Tabs. . One to be taken at the onset of symptoms and repeat after 2 hours if symptoms are not settling. Dispense x 6 tabs. Repeat x 6\/12."
    },
    {
        "num": "165",
        "name": "Imigran Migraine nasal spray",
        "line1": "Imigran Migraine nasal spray",
        "desc": "Imigran 10mg nasal spray Dispense 1 box and repeat x 6\\n\\n1-2 sprays into one nostril at the start of a migraine attack. Repeat dose at an interval of 2 hours and only if there has been some improvement of pain."
    },
    {
        "num": "254",
        "name": "Imodium Loperamide anti diarrheal",
        "line1": "Imodium Loperamide anti diarrheal",
        "desc": "Imodium (Loperamide) 2mg 2 capsules P.O. Stat and then one T.I.D.\/P.R.N Dispense\u00a020 caps."
    },
    {
        "num": "149",
        "name": "Incruse ellipta Inhaler",
        "line1": "Incruse ellipta Inhaler",
        "desc": "Incruse ellipta 55mcgs 1 Puff O.D x 1\/12 repeat x 6\/12\\n\\n"
    },
    {
        "num": "97",
        "name": "Itraconzole, ring worm treatment",
        "line1": "Itraconzole, ring worm treatment",
        "desc": "Itraconazole\u00a0400mg PO OD 2\/52\\n"
    },
    {
        "num": "156",
        "name": "Janumet\u00a0Diabetes",
        "line1": "Janumet\u00a0Diabetes",
        "desc": "Janumet\u00a050\/1000 milligram(s) Film-coated tablet.P.O B.D . Dispense 56 tablets. Repeat x 6"
    },
    {
        "num": "244",
        "name": "Klacid Clarithromycin Abx",
        "line1": "Klacid Clarithromycin Abx",
        "desc": "Klacid LA (Clarithromycin) 500mg. P.O. B.D. x 5\/7"
    },
    {
        "num": "129",
        "name": "Kliogest HRT",
        "line1": "Kliogest HRT",
        "desc": "Kliogest 2mg\/1mg film-coated tablets. One tablet daily. Dispense x 28 tablets. Repeat x 3"
    },
    {
        "num": "229",
        "name": "Lansoprazole PPI",
        "line1": "Lansoprazole PPI",
        "desc": "Lansoprazole Specify 15 or 30mg P.O. O.D. x 1\/12 repeat x 6\/12"
    },
    {
        "num": "134",
        "name": "Lantus Solostar Diabetes",
        "line1": "Lantus Solostar Diabetes",
        "desc": "Lantus Solostar 100units\/ml\u00a03ml Disposable Pen. Dose as per plan\\nDispense x 2\u00a0Packs of 5 Pens. Repeat x 6"
    },
    {
        "num": "98",
        "name": "Leonore tablets",
        "line1": "Leonore tablets",
        "desc": "Leonore (0.1 mg of levonorgestrel and 0.02 mg of ethinylestradiol)\u00a0coated tablets\\n\\nThe tablets must be taken every day at about the same time, if necessary with a little liquid, in the order shown on the blister pack. One tablet is to be taken daily for 21 consecutive days. Every subsequent blister pack is started after a 7-day tablet-free interval\u00a0 during which time a withdrawal bleeding usually occurs.\u00a0 Mitte\u00a0x 1\/12\u00a0& Repeat for 6\/12."
    },
    {
        "num": "333",
        "name": "LEVITRA 5\/10\/20mg",
        "line1": "LEVITRA 5\/10\/20mg",
        "desc": "LEVITRA 5\/10\/20mg\\nVardenafil {Levitra} 5\/10\/20mg tablets. P.O. 4 tablets x 6 [ 24 (maximum) tablets]\\n\\nTake 30-60mins prior to sexual activity to max 1 tablet in any 24 hours.\\n\\nFor further instructions please read the leaflet"
    },
    {
        "num": "11",
        "name": "Levofloxacin\u00a0if other 2 are not suitable",
        "line1": "Levofloxacin\u00a0if other 2 are not suitable",
        "desc": "Levofloxacin\u00a0500 mg orally once daily for seven days"
    },
    {
        "num": "64",
        "name": "Levonorgestrel 1.5mg",
        "line1": "Levonorgestrel 1.5mg",
        "desc": "Levonorgestrel 1.5mg Please dispense ONE\u00a0tablet only.\\n\\nThe tablet should be taken as soon as possible after sexual intercourse.\u00a0"
    },
    {
        "num": "63",
        "name": "Levonorgestrel 1.5mg (Double dose)",
        "line1": "Levonorgestrel 1.5mg (Double dose)",
        "desc": "Levonorgestrel 1.5mg Please dispense TWO tablet only.\\n\\nThe tablet should be taken as soon as possible after sexual intercourse.\u00a0"
    },
    {
        "num": "191",
        "name": "Loceryl Lacquer Soln. Topical Antifungal Dermatophyte Fingernails and Toenails",
        "line1": "Loceryl Lacquer Soln. Topical Antifungal Dermatophyte Fingernails and Toenails",
        "desc": "Loceryl Lacquer Soln.\u00a0 x 1 and repeat for 6\/12.\\n\\nApply twice weekly to the affected nails. Apply on the same days."
    },
    {
        "num": "217",
        "name": "Locoid Lipocream Topical Steroid",
        "line1": "Locoid Lipocream Topical Steroid",
        "desc": "Locoid Lipocream T.I.D. x 1\/52\u00a0then reduce to B.I.D. x 1\/52 and then Nocte x 1\/52 and then alternate nights x 1\/52\u00a0and then stop.\u00a0Apply sparingly to the affected areas and avoid prolonged continuous use."
    },
    {
        "num": "319",
        "name": "Logynon Tablets",
        "line1": "Logynon Tablets",
        "desc": "Logynon Tablets (Each light brown tablet contains: Ethinylestradiol 30 micrograms Levonorgestrel 50 micrograms Each white tablet contains: Ethinylestradiol 40 micrograms Levonorgestrel 75 micrograms Each ochre-coloured tablet contains: Ethinylestradiol 30 micrograms Levonorgestrel 125 micrograms)\\n\\nThe memo-pack contains 21 tablets. Tablet-taking is always started from the section marked \u201cStart\u201d and then continued daily\\ninthe direction of the arrows.\u00a0Tablets must be taken in the order directed on the package every day at about the same time with some liquid as needed. One tablet is to be taken daily for 21\u00a0consecutive days. Each subsequent pack is started after a 7\u2011day tablet-free interval, during which time a withdrawal bleed usually occurs. This usually starts on day 2\u20113 after the last coated tablet and may not have finished before the next pack is started.\\n\\nMitte 1\/12 and repeat 6\/12\\n\\nFurther instructions are in your Patient Record."
    },
    {
        "num": "223",
        "name": "Lotriderm Cream Topical Antifungal + Steroid",
        "line1": "Lotriderm Cream Topical Antifungal + Steroid",
        "desc": "Lotriderm Cream. T.I.D. x 1\/52\u00a0then reduce to B.I.D. x 1\/52 and then nocte x 1\/52 and then alternate nights x 1\/52\u00a0and then stop.\u00a0Apply sparingly to the affected areas and avoid prolonged continuous use."
    },
    {
        "num": "136",
        "name": "Lyclear (Permethrin) Scabies",
        "line1": "Lyclear (Permethrin) Scabies",
        "desc": "Lyclear (Permethrin) 5% w\/w Dermal Cream. Apply once. 30gm tube. Dispense 1 or 2 tubes"
    },
    {
        "num": "341",
        "name": "Marviol tablets [ 126 Tablets ]",
        "line1": "Marviol tablets [ 126 Tablets ]",
        "desc": "MARVIOL\\nMarviol tablets [ 126 Tablets ]\\n\\nDirections to use : One tablet daily for 21 days."
    },
    {
        "num": "328",
        "name": "Medroxyprogesterone acetate {Provera}",
        "line1": "Medroxyprogesterone acetate {Provera}",
        "desc": "Medroxyprogesterone acetate {Provera}\\nMedroxyprogesterone acetate {Provera} 10mgs tds Mitte x 5 DAYS.\\n\\nDirections to use: Treatment should be started three days before menstruation is likely to begin. After discontinuing these medications, you should have a regular period in 2-3 days."
    },
    {
        "num": "18",
        "name": "Mefenamic acid\u00a0250 mg for period cramps",
        "line1": "Mefenamic acid\u00a0250 mg for period cramps",
        "desc": "Mefenamic acid 250 mg every 6 hours 1\/52"
    },
    {
        "num": "68",
        "name": "Melatonin 3mg",
        "line1": "Melatonin 3mg",
        "desc": "Melatonin 3mg PO OD x 2\/52\\n\\nOne tablet to be taken once a day 45 minutes before sleeping in the night for 2 weeks.\u00a0The dose may be increased to 6 mg (2 tablets taken together) if the standard dose does not adequately alleviate symptoms. Review after that if needed."
    },
    {
        "num": "339",
        "name": "Mercilon tablets [ 126 Tablets ]",
        "line1": "Mercilon tablets [ 126 Tablets ]",
        "desc": "MERCILON\\nMercilon tablets [ 126 Tablets ]\\n\\nDirections to use : One tablet daily for 21 days. ."
    },
    {
        "num": "206",
        "name": "Metformin Diabetes",
        "line1": "Metformin Diabetes",
        "desc": "Metformin 500mg P.O. B.D. x 1\/12 and repeat x 6\/12.\\n"
    },
    {
        "num": "41",
        "name": "Metoclopramide Hydrochloride 5mg\/5ml",
        "line1": "Metoclopramide Hydrochloride 5mg\/5ml",
        "desc": "Metoclopramide Hydrochloride 5mg\/5ml Oral Solution\u00a0 Dosage:\u00a02.5 mg (2.5ml)\u00a0\u00a03 times daily for 5 days"
    },
    {
        "num": "122",
        "name": "Metronidazole 200mg\/5ml Paediatrics Abx",
        "line1": "Metronidazole 200mg\/5ml Paediatrics Abx",
        "desc": "Metronidazole liquid 200mg\/5ml\u00a0SPICIFY DOSE T.I.D x 5\/7\\n"
    },
    {
        "num": "241",
        "name": "Metronidazole Abx",
        "line1": "Metronidazole Abx",
        "desc": "Metronidazole 400mg\u00a0 P.O.\u00a0B.D. for 1 week.\\n\\nAvoid drinking alcohol when using this medicine and for 72 hours after."
    },
    {
        "num": "155",
        "name": "Mezavant XL  Mesalamine IBD",
        "line1": "Mezavant XL  Mesalamine IBD",
        "desc": "Mezavant XL 1200mg \u00a01-2 P.O O.D X 1\/12"
    },
    {
        "num": "262",
        "name": "Miconazole Antifungal Topical Powder",
        "line1": "Miconazole Antifungal Topical Powder",
        "desc": "Miconazole Nitrate 2% Powder\u00a0 x 20g, repeat x 6 times.\\n\\nSprinkle into both socks and shoes each morning for 1 month.\u00a0Repeat for a further two months if required."
    },
    {
        "num": "96",
        "name": "Miconazole vaginal cream prescription only (Vulvovaginal candidiasis or Vaginal thrush)",
        "line1": "Miconazole vaginal cream prescription only (Vulvovaginal candidiasis or Vaginal thrush)",
        "desc": "Miconazole vaginal cream (Gyno-Daktarin) with use of applicator Two applicators (10g) once daily at night for 7 days or one applicator (5g) once daily at night for 14 days\\n\\nUse of an applicator is not recommended during pregnancy. Latex condoms and diaphragms ca be damaged by vaginal creams and pessaries, extra precautions are advised."
    },
    {
        "num": "343",
        "name": "Microlite tablets [ 126 Tablets ]",
        "line1": "Microlite tablets [ 126 Tablets ]",
        "desc": "MICROLITE\\nMicrolite tablets [ 126 Tablets ]\\n\\nDirections to use : One tablet daily for 21 days."
    },
    {
        "num": "84",
        "name": "MINULET",
        "line1": "MINULET",
        "desc": "MINULET\u00ae 75 micrograms\/30 micrograms coated tablets\u00a0The tablets must be taken every day at about the same time, if necessary with a little liquid, in the order shown on the blister pack. One tablet is to be taken daily for 21 consecutive days. Every subsequent blister pack is started after a 7-day tablet-free interval\u00a0 during which time a withdrawal bleeding usually occurs.\u00a0 Mitte\u00a0x 1\/12\u00a0& Repeat for 6\/12.\\nFurther instructions are in your Patient Record."
    },
    {
        "num": "102",
        "name": "Modafinil 200mg to treat sleepiness",
        "line1": "Modafinil 200mg to treat sleepiness",
        "desc": "Modafinil 200mg P.O, O.D\u00a0 Dispense 28 (TWENTY EIGHT)\u00a0tablets."
    },
    {
        "num": "81",
        "name": "Molaxole laxatives",
        "line1": "Molaxole laxatives",
        "desc": "Molaxole\u00ae Powder for Oral Solution\u00a0(macrogol 3350\/sodium chloride\/sodium hydrogen carbonate\/potassium chloride) 1-2 sachets to be taken daily\u00a0"
    },
    {
        "num": "115",
        "name": "Mometasone furoate nasal spray",
        "line1": "Mometasone furoate nasal spray",
        "desc": "Mometasone furoate nasal spray\u00a0100mcg two sprays in each nostril twice daily for 1 week then reduce to one spray in each nostril for 1 week. x 1\/12"
    },
    {
        "num": "160",
        "name": "Movicol Paediatric Plain  Constipation",
        "line1": "Movicol Paediatric Plain  Constipation",
        "desc": "Movicol Paediatric Plain 6.9 g sachet, 1- 2 sachets per day Dispense 30 sachet. If no improvement in 1 week see your GP."
    },
    {
        "num": "261",
        "name": "Mycostatin liquid Antifungal",
        "line1": "Mycostatin liquid Antifungal",
        "desc": "Mycostatin (Nystatin100,000units\/ml) Oral Drops. One ml P.O. Q.I.D. x 1"
    },
    {
        "num": "30",
        "name": "Mysimba  starters",
        "line1": "Mysimba  starters",
        "desc": "Mysimba 8 mg\/90 mg prolonged-release tablets\\n\\n\u2022 Week 1: One tablet in the morning \u2022 Week 2: One tablet in the morning and one tablet in the evening \u2022 Week 3: Two tablets in the morning and one tablet in the evening \u2022 Week 4 and onwards: Two tablets in the morning and two tablets in the evening\\n\\nMitte 1\/12 and repeat 3\/12"
    },
    {
        "num": "29",
        "name": "Mysimba continuation",
        "line1": "Mysimba continuation",
        "desc": "Mysimba 8 mg\/90 mg prolonged-release tablets Two tablets in the morning and two tablets in the evening\\n\\nMitte 1\/12 and repeat 3\/12"
    },
    {
        "num": "40",
        "name": "Naratriptan 2.5mg\u00a0Migriane",
        "line1": "Naratriptan 2.5mg\u00a0Migriane",
        "desc": "Naratriptan 2.5mg\u00a0\\n\\nOne to be taken at the onset of symptoms\u00a0 Dispense x 6 tabs. Repeat x 6\/12."
    },
    {
        "num": "54",
        "name": "Naseptin Nasal Cream",
        "line1": "Naseptin Nasal Cream",
        "desc": "Naseptin 0.1% & 0.5% w\/w Nasal Cream\u00a0\\n\\nA small amount of 'Naseptin' is placed on the little finger and applied to the inside of each nostril. Apply 2-4 times a day or as directed for 10 days.\u00a0Miite x 1 tube"
    },
    {
        "num": "140",
        "name": "Naseptin Topical Abx",
        "line1": "Naseptin Topical Abx",
        "desc": "Naseptin\u00a0Nasal Cream. Q.I.D x 10\/7. Dispense 15g tube."
    },
    {
        "num": "176",
        "name": "Nasocort [Triamcinalone acetonide 55mcg] Nasal spray Steroid",
        "line1": "Nasocort [Triamcinalone acetonide 55mcg] Nasal spray Steroid",
        "desc": "Nasocort [Triamcinalone acetonide 55mcg] 1 spray per nostril dail\u00a0 repeat x 6\/12"
    },
    {
        "num": "170",
        "name": "Nasofan Aqueous\u00a0Nasal Spray Allergy",
        "line1": "Nasofan Aqueous\u00a0Nasal Spray Allergy",
        "desc": "Nasofan Aqueous\u00a0Spray 2 sprays to each nostril mane x 2\/52\u00a0and then when symptoms are controlled,\u00a0reduce to 1spray each nostril mane as maintenance x 1\/12 and repeat x 6\/12.\\n\\nAlways gargle with water after using this spray"
    },
    {
        "num": "306",
        "name": "Nasonex Nasal Spray",
        "line1": "Nasonex Nasal Spray",
        "desc": "Nasonex Nasal Spray: 2 sprays to each nostril mane x 2\/52\u00a0and then when symptoms are controlled,\u00a0reduce to 1 spray each nostril mane as maintenance.\u00a0x 1\/12 and repeat x 6\/12.\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS NASAL SPRAY.\u00a0"
    },
    {
        "num": "151",
        "name": "Nizoral (Ketoconazole) Topical",
        "line1": "Nizoral (Ketoconazole) Topical",
        "desc": "Etoflam 5% Cream. T.I.D\/P.R.N x 1 tube. Massage well into affected area.\u00a0\\n\\n"
    },
    {
        "num": "345",
        "name": "Noriday tablets [ 168 Tablets ]",
        "line1": "Noriday tablets [ 168 Tablets ]",
        "desc": "NORIDAY\\nNoriday tablets [ 168 Tablets ]\\n\\nDirections to use : Take one tablet daily, at the same time every day."
    },
    {
        "num": "135",
        "name": "Novorapid Insulin Diabetes",
        "line1": "Novorapid Insulin Diabetes",
        "desc": "Novorapid Insulin\u00a0100units\/ml\u00a03ml Cartridges. Dose as per blood glucose readings.\\nDispense x 2\u00a0Packs (of 5 Cartridges). Repeat x 6"
    },
    {
        "num": "344",
        "name": "Nuvaring 6 month [ 2 Packs of 3 rings ]",
        "line1": "Nuvaring 6 month [ 2 Packs of 3 rings ]",
        "desc": "NUVARING\\nNuvaring 6 month [ 2 Packs of 3 rings ]\\n\\nDirections to use : Insert ring into vagina on day 1 of cycle and leave in for 3 weeks; remove ring on day 22; subsequent courses repeated after 7-day ring-free interval"
    },
    {
        "num": "242",
        "name": "Ofloxacin\u00a0 Abx",
        "line1": "Ofloxacin\u00a0 Abx",
        "desc": "Ofloxacin 400mg P.O.B.D. x 2\/52"
    },
    {
        "num": "154",
        "name": "Oilatum Shower Gel emollient topical",
        "line1": "Oilatum Shower Gel emollient topical",
        "desc": "Oilatum Shower Gel 70% w\/w Gel.\u00a0 Dispense 150g. Repeat x 6\\n\\nUse as a soap substitute."
    },
    {
        "num": "145",
        "name": "Olmesartan",
        "line1": "Olmesartan",
        "desc": "Olmesartan 40mg P.O O.D x 1\/12 Repeat x 6\/12"
    },
    {
        "num": "272",
        "name": "Omeprazole PPI",
        "line1": "Omeprazole PPI",
        "desc": "Omeprazole  10\/20\/40 mg P.O. O.D. x 1\/12 and repeat x 6\/12."
    },
    {
        "num": "320",
        "name": "Ondasteron (Zofran)",
        "line1": "Ondasteron (Zofran)",
        "desc": "Ondasteron 8 mg orally 3 times a day for 5 days.\\n\\nPlease check your online account for further instructions or read the leaflet"
    },
    {
        "num": "187",
        "name": "Opatanol eye drops allergic conjunctivitis and allergic rhinitis.",
        "line1": "Opatanol eye drops allergic conjunctivitis and allergic rhinitis.",
        "desc": "Opatanol eye drops 5 mls 1 drop in the affected eye B.D\/P.R.N x 1\/12 and repeat x 6\/12"
    },
    {
        "num": "60",
        "name": "Ovranette\u00a0tablets",
        "line1": "Ovranette\u00a0tablets",
        "desc": "OVRANETTE\\nOvranette\u00a0tablets [ 126 Tablets ]\\n\\nDirections to use : One tablet daily for 21 days.\\n\\nPlease check your online account for further instructions or read the leaflet"
    },
    {
        "num": "107",
        "name": "Ovranette tablets",
        "line1": "Ovranette tablets",
        "desc": "Ovranette tablets [ 126 Tablets ]\\nDirections to use : One tablet daily for 21 days.\\n\\nFor further instructions please read the leaflet"
    },
    {
        "num": "348",
        "name": "Ovreena tablets [ 126 Tablets ]",
        "line1": "Ovreena tablets [ 126 Tablets ]",
        "desc": "OVREENA\\nOvreena tablets [ 126 Tablets ]\\n\\nDirections to use : One tablet daily for 21 days.\\n\\nFor further instructions please read the leaflet"
    },
    {
        "num": "59",
        "name": "Pantoprazole 40mg",
        "line1": "Pantoprazole 40mg",
        "desc": "Pantoprazole 40mg, one tablet to be taken in the morning\u00a0\\n\\nMiite 1\/12 and repeat 6\/12"
    },
    {
        "num": "38",
        "name": "Paxlovid for COVID",
        "line1": "Paxlovid for COVID",
        "desc": "Paxlovid twice a day for 5 days"
    },
    {
        "num": "249",
        "name": "Phenergan Syrup\u00a0 (Promethazine) Antihistamine Paediatrics",
        "line1": "Phenergan Syrup\u00a0 (Promethazine) Antihistamine Paediatrics",
        "desc": "Phenergan Syrup\u00a0 (Promethazine) 5mg\/5ml x 100ml\\n\\nChild 2\u20134 years\\n\\n5\u00a0mg twice daily, alternatively 5\u201315\u00a0mg once daily, dose to be taken at night.\\n\\nChild 5\u20139 years\\n\\n5\u201310\u00a0mg twice daily, alternatively 10\u201325\u00a0mg once daily, dose to be taken at night.\\n\\nChild 10\u201317 years\\n\\n10\u201320\u00a0mg 2\u20133 times a day, alternatively 25\u00a0mg once daily, dose to be taken at night, increased if necessary to 25\u00a0mg twice daily."
    },
    {
        "num": "259",
        "name": "Phenoxymethylpenicillin  Paediaterics Abx",
        "line1": "Phenoxymethylpenicillin  Paediaterics Abx",
        "desc": "Phenoxymethylpenicillin 250mg\/5ml \u00a0SELECT DOSE\u00a0mg P.O. Q.I.D. x 10\/7 days."
    },
    {
        "num": "260",
        "name": "Phenoxymethylpenicillin Abx",
        "line1": "Phenoxymethylpenicillin Abx",
        "desc": "Phenoxymethylpenicillin 666mg P.O. Q.I.D. x 5 days."
    },
    {
        "num": "315",
        "name": "Piriton (Chlorpheniramine) Antihistamine",
        "line1": "Piriton (Chlorpheniramine) Antihistamine",
        "desc": "Piriton (Chlorpheniramine) 4mg P.O.\u00a0Q.I.D\/P.R.N Dispense x 30 tabs\\n\\nThis medicine may cause drowsiness. Avoid Alcohol with this medicine."
    },
    {
        "num": "257",
        "name": "Ponstan  Analgesia NSAID Menstrual",
        "line1": "Ponstan  Analgesia NSAID Menstrual",
        "desc": "Ponstan Fort. 1 tab. P.O. T.I.D.\u00a0\u00a0x 3\/52 tabs, repeat x 3"
    },
    {
        "num": "189",
        "name": "Pravastatin",
        "line1": "Pravastatin",
        "desc": "Pravastatin 40mg tP.O. Nocte. x 1\/12 and repeat x 6\/12\\n"
    },
    {
        "num": "48",
        "name": "Pred Forte 1% w\/v, Eye Drops Suspension",
        "line1": "Pred Forte 1% w\/v, Eye Drops Suspension",
        "desc": "Pred Forte 1% w\/v, Eye Drops Suspension\u00a0One to two drops instilled into the conjunctival sac two to four times daily"
    },
    {
        "num": "205",
        "name": "Prednesol  Steroid Paediatrics",
        "line1": "Prednesol  Steroid Paediatrics",
        "desc": "Prednesol 5mg Tabs. 20mg\u00a0P.O. O.D. x 4\/7 then reduce to\u00a015mg P.O.O.D. x\u00a03\/7 then reduce to 5mg P.O.O.D. x 2\/7 and then to 2.5mg P.O.O.D. x 1\/7 and then stop."
    },
    {
        "num": "322",
        "name": "Prednisolone 40mg steroids",
        "line1": "Prednisolone 40mg steroids",
        "desc": "Prednisolone 40mg (8*5mg tablets) O.D. (morning) x 5\/7.\\n\\nStop using if causes stomach pain. Avoid prolonged use.\u00a0"
    },
    {
        "num": "89",
        "name": "Pregnant women- Recurrent vulvovaginal candidiasis (Thrush)",
        "line1": "Pregnant women- Recurrent vulvovaginal candidiasis (Thrush)",
        "desc": "Cloritomazole 200mg pessary once daily for 6 nights.\\n\\nUse of an applicator is not recommended during pregnancy. Latex condoms and diaphragms ca be damaged by vaginal creams and pessaries, extra precautions are advised.\\n"
    },
    {
        "num": "88",
        "name": "Pregnant women- Vulvovaginal candidiasis (Thrush)",
        "line1": "Pregnant women- Vulvovaginal candidiasis (Thrush)",
        "desc": "Cloritomazole 200mg pessary once daily for 3 nights.\\n\\nUse of an applicator is not recommended during pregnancy. Latex condoms and diaphragms ca be damaged by vaginal creams and pessaries, extra precautions are advised."
    },
    {
        "num": "47",
        "name": "Preparation H Ointment 25g for hemorrhoids.",
        "line1": "Preparation H Ointment 25g for hemorrhoids.",
        "desc": "Preparation H rectal Ointment 25g 4 times daily x 1\/52"
    },
    {
        "num": "329",
        "name": "Primulut N (Norethisterone)",
        "line1": "Primulut N (Norethisterone)",
        "desc": "Primulut N (Norethisterone)\\nPrimulut N (Norethisterone) 5mg Tabs. One P.O. T.I.D. Mitte x 9 days\u2019 supply.\\n\\nDirections to use: Treatment should be started three days before menstruation is likely to begin. After discontinuing these medications, you should have a regular period in 2-3 days.\\n\\nPlease beware! During the therapy cycle, pregnancy must be avoided. Please be advised that, while the goal is to postpone the period, spotting or heavy bleeding may still occur!"
    },
    {
        "num": "255",
        "name": "Prochlorperazine Stemetil Antiemetic",
        "line1": "Prochlorperazine Stemetil Antiemetic",
        "desc": "Prochlorperazine (Stemetil) tabs 5mg, 1-2 P.R.N\/Q.I.D Dispense 20 tablets\\navoid\u00a0driving or operating machinery, this medication can cause drowsiness."
    },
    {
        "num": "46",
        "name": "Proctosedyl Ointment In the local management of pain, pruritus and inflammation associated with internal or external haemorrhoids, and such haemorrhoidal complications as fissures, proctitis, perianal eczema, and post-operative states.",
        "line1": "Proctosedyl Ointment In the local management of pain, pruritus and inflammation associated with internal or external haemorrhoids, and such haemorrhoidal complications as fissures, proctitis, perianal eczema, and post-operative states.",
        "desc": "Proctosedyl Ointment\u00a0Application to external surface or by means of the cannula into the rectum, twice daily and after each bowel movement.\u00a0 Treatment should last for a week."
    },
    {
        "num": "166",
        "name": "Proctosedyl suppositories topical\u00a0 haemorrhoids",
        "line1": "Proctosedyl suppositories topical\u00a0 haemorrhoids",
        "desc": "Proctosedyl suppositories\u00a0 B.D\u00a0 x 1\/52 repeat x 2.\u00a0\\n\\nProctosedyl ointment B.D \/P.R.N. Dispense 30g"
    },
    {
        "num": "162",
        "name": "Promethazine (Phenergan) 25mg tabs. Antihistamine Insomnia",
        "line1": "Promethazine (Phenergan) 25mg tabs. Antihistamine Insomnia",
        "desc": "Promethazine (Phenergan) 25mg tabs. P.O Nocte. Dispense x 14 tablets."
    },
    {
        "num": "13",
        "name": "Propranolol",
        "line1": "Propranolol",
        "desc": "Propranolol 40 mg PO OD 1\/12 \u00a0,repeat 6\/12\u00a0"
    },
    {
        "num": "309",
        "name": "Propranolol - Anxiety",
        "line1": "Propranolol - Anxiety",
        "desc": "Propranolol 10mg \u00a0P.O. O.D. Dispense x 10 tabs\\n\\nTake one as directed."
    },
    {
        "num": "39",
        "name": "Pulmicort  nebuliser",
        "line1": "Pulmicort  nebuliser",
        "desc": "Pulmicort Respules 1 mg\/2ml nebuliser suspension\u00a0 1 mg twice daily for 5\/7\\n\\nAdults (including elderly): Usually 1 - 2 mg twice daily. In very severe cases, the dosage may be further increased.\\n\\nChildren of 12 years and older: Dosage as for adults.\\n\\nChildren of 3 months to 12 years: 0.5 - 1 mg twice daily."
    },
    {
        "num": "297",
        "name": "Pulmicort (Budesonide) Turbohaler - Inhaler",
        "line1": "Pulmicort (Budesonide) Turbohaler - Inhaler",
        "desc": "Pulmicort (Budesonide) Turbohaler 200 mcg. 1 puff B.D. \u00a0x 1\/12 and\u00a0repeat x 6\/12\u00a0\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS INHALER."
    },
    {
        "num": "340",
        "name": "Qlaira tablets [ 168 Tablets ]",
        "line1": "Qlaira tablets [ 168 Tablets ]",
        "desc": "QLAIRA\\nQlaira tablets [ 168 Tablets ]\\n\\nDirections to use : One tablet daily in order directed on pack"
    },
    {
        "num": "274",
        "name": "Quetiapine",
        "line1": "Quetiapine",
        "desc": "Quetiapine 25mg P.O. To be taken 1-2 or more hours prior to bedtime.\u00a0Dispense x 10 tabs.\\nAvoid\u00a0driving or operating machinery as this medicine\u00a0can cause drowsiness."
    },
    {
        "num": "228",
        "name": "Rabeprazole\u00a0PPI",
        "line1": "Rabeprazole\u00a0PPI",
        "desc": "Rabeprazole Specify 10 or 20 mg. P.O. O.D. x 1\/12 repeat x 6\/12."
    },
    {
        "num": "226",
        "name": "Rectogesic  Haemorrhoids Topical",
        "line1": "Rectogesic  Haemorrhoids Topical",
        "desc": "Rectogesic (Glyceryl Trinitrate). Apply as directed to the affected area B.D. Dispense 1 30g tube."
    },
    {
        "num": "90",
        "name": "Recurrent vulvovaginal candidiasis (Thrush)",
        "line1": "Recurrent vulvovaginal candidiasis (Thrush)",
        "desc": "Fluconazole 150mg PO Days 1, 4 and 7 then weekly for 6 months.\\n\\nAvoid fluconazole in pregnancy."
    },
    {
        "num": "132",
        "name": "Relpax\u00a0(Eletriptan) Migraine",
        "line1": "Relpax\u00a0(Eletriptan) Migraine",
        "desc": "Relpax\u00a0(Eletriptan)\u00a040mg. P.O. O.D\/P.R.N. Dispense pack of 6 and repeat x 6\/12\\n\\nIf another attack occurs after the initial dose, a second dose\u00a0 aybe taken after 2 hour interval.\\n\\nIf there is no response to the initial dose DO NOT administer another dose."
    },
    {
        "num": "294",
        "name": "Relvar Ellipta Inhaler",
        "line1": "Relvar Ellipta Inhaler",
        "desc": "Relvar Ellipta 92\/22. 1puff O.D x\u00a01\/12 and repeat x 6\/12\\n\\n\u00a0ALWAYS GARGLE WITH WATER AFTER USING THIS INHALER."
    },
    {
        "num": "178",
        "name": "Rozex Gel (Metronidazole 0.75%) Rosacea",
        "line1": "Rozex Gel (Metronidazole 0.75%) Rosacea",
        "desc": "Rozex Gel (Metronidazole 0.75%). Apply to clean dry skin B.D. Repeat x 3\/12"
    },
    {
        "num": "300",
        "name": "Salamol Inhaler",
        "line1": "Salamol Inhaler",
        "desc": "Salamol Easi Breathe Inhaler\u00a0100mcg\u00a01-2 puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "32",
        "name": "Salamol Steri-Neb 5 mg\/2.5 ml Nebuliser Solution salbutamol (as sulfate)",
        "line1": "Salamol Steri-Neb 5 mg\/2.5 ml Nebuliser Solution salbutamol (as sulfate)",
        "desc": "Salamol Steri-Neb 5 mg\/2.5 ml Nebuliser Solution salbutamol (as sulfate)\\n\\nThe recommended dose is:\\n\\nAdults (including elderly) and adolescents aged 12 years and over:\\n\\nThe starting dose is 2.5 mg taken by wet inhalation. Your doctor may increase this to 5 mg. Treatment may be repeated up to four times a day. The maximum daily dose is normally 20 mg per day.\\n\\nFor treatment of severe airways obstruction, the maximum dose of 40 mg per day can only be given under strict medical supervision in hospital.\\n\\nChildren aged 4 to 11 years:\\n\\nThe starting dose is 2.5 mg taken by wet inhalation. Their doctor may increase this to 5 mg. Treatment may be repeated up to four times a day.  Children should be supervised by a responsible adult when they are using a nebuliser.\\n\\nChildren under 4 years of age:\\n\\nOther pharmaceutical forms may be more appropriate for children under 4 years. Method of administration Salamol Steri-Neb MUST be used by inhalation only and breathed in through the mouth. The solution MUST NOT be injected or swallowed."
    },
    {
        "num": "31",
        "name": "Saline Steri-Neb 0.9% w\/v Nebuliser Solution",
        "line1": "Saline Steri-Neb 0.9% w\/v Nebuliser Solution",
        "desc": "Saline Steri-Neb 0.9% w\/v Nebuliser Solution"
    },
    {
        "num": "105",
        "name": "Saxenda First time user prescription",
        "line1": "Saxenda First time user prescription",
        "desc": "Saxenda 6 mg\/ml solution for injection in pre-filled pen x 5 (1 ml of solution contains 6 mg of liraglutide*. One pre-filled pen contains 18 mg liraglutide in 3 ml.).\u00a0\\n\\nPlease also dispense include100 needles along with Saxenda pen.\\n\\nDose escalation schedule:\\n\\n0.6mg daily for one week and increase by 0.6mg each week until you reach your maintenance dose which is usually 3mg\\nOn maintenance dose of 3mg, each pen will last 6 days"
    },
    {
        "num": "112",
        "name": "Saxenda repeat prescription",
        "line1": "Saxenda repeat prescription",
        "desc": "Saxenda 6 mg\/ml solution for injection in pre-filled pen x 5\u00a0(1 ml of solution contains 6 mg of liraglutide*. One pre-filled pen contains 18 mg liraglutide in 3 ml.). A maintenance dose of 3mg to be injected as directed daily.\u00a0\\n\\nOn maintenance dose of 3mg\\n\\nPlease also dispense include100 needles along with Saxenda pen"
    },
    {
        "num": "227",
        "name": "Scheriproct \u00a0Suppositories Topical Haemorrhoids",
        "line1": "Scheriproct \u00a0Suppositories Topical Haemorrhoids",
        "desc": "Scheriproct \u00a0Suppositories. One P.R. O.D. as directed. Dispense 1 box suppositories..\\n\\nScheriproct Ointment\u00a0Use as directed on the affected area. 30gram tube."
    },
    {
        "num": "148",
        "name": "Selsun Shampoo 2.5% w\/v.",
        "line1": "Selsun Shampoo 2.5% w\/v.",
        "desc": "Selsun Shampoo 2.5% w\/v. Dispense x 100ml. Repeat x 3\\n\\nMassage Selsun and\u00a0 rinse after 2 to 3 minutes.\u00a0 Use twice a week for the first two weeks and then once a week for the next two weeks to control the condition.\u00a0"
    },
    {
        "num": "9",
        "name": "Semaglutide for weight loss Weeks 1-4",
        "line1": "Semaglutide for weight loss Weeks 1-4",
        "desc": "Semaglutide prefilled injection 0.25mg weekly into tummy, thigh or upper arm\u00a0for 4 weeks"
    },
    {
        "num": "6",
        "name": "Semaglutide for weight loss Weeks 13-16",
        "line1": "Semaglutide for weight loss Weeks 13-16",
        "desc": "Semaglutide prefilled injection 1.7 mg weekly into tummy, thigh or upper arm\u00a0for 4 weeks"
    },
    {
        "num": "5",
        "name": "Semaglutide for weight loss Weeks 17 onwards",
        "line1": "Semaglutide for weight loss Weeks 17 onwards",
        "desc": "Semaglutide prefilled injection 2mg or 2.4mg\u00a0weekly into tummy, thigh or upper arm\u00a0for 4 weeks"
    },
    {
        "num": "8",
        "name": "Semaglutide for weight loss Weeks 5-8",
        "line1": "Semaglutide for weight loss Weeks 5-8",
        "desc": "Semaglutide prefilled injection 0.5mg weekly into tummy, thigh or upper arm\u00a0for 4 weeks"
    },
    {
        "num": "7",
        "name": "Semaglutide for weight loss Weeks 9-12",
        "line1": "Semaglutide for weight loss Weeks 9-12",
        "desc": "Semaglutide prefilled injection 1 mg weekly into tummy, thigh or upper arm\u00a0for 4 weeks"
    },
    {
        "num": "314",
        "name": "Serc (Betahistine Dihydrochloride)",
        "line1": "Serc (Betahistine Dihydrochloride)",
        "desc": "Serc (Betahistine Dihydrochloride) 16mg P.O.\u00a0T.I.D x 1\/52 Repeat x 2"
    },
    {
        "num": "301",
        "name": "Seretide + Ventolin Inhaler",
        "line1": "Seretide + Ventolin Inhaler",
        "desc": "1.\u00a0Seretide 250 mcg. \u00a02 puffs B.D x\u00a01\/12\u00a0and repeat for 6\/12\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS INHALER.\u00a0\\n\\n\\n\\n2.\u00a0Salbutamol\/Ventolin Inhaler. 100mcg\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "106",
        "name": "Seretide 125mcg Boosting with Ventolin",
        "line1": "Seretide 125mcg Boosting with Ventolin",
        "desc": "Seretide 125mcg. \u00a0Boost to 3 doses three times a day for a week, then reduce to 3 doses twice a day the second week and then two doses twice a day for the third week and then back to one dose twice a day as maintenance therapy. . ALWAYS GARGLE WITH WATER AFTER USING THIS INHALER. Mitte \u00a0x 1\/12 and repeat 6\/12\\n\\nVentolin\/Salbutamol inhaler 100 mcg. 1-2 puffs PRN \u00a0Mitte x 1\/12. Repeat x Once ONLY. This is a rescue inhaler. Regular daily use of this inhaler indicates inadequate control of asthma and medical review is advised. A steroid inhaler should be used instead."
    },
    {
        "num": "17",
        "name": "Seretide Diskus 250mcg  And Ventollin",
        "line1": "Seretide Diskus 250mcg  And Ventollin",
        "desc": "1.\u00a0\u00a0Seretide Diskus 250mcg\u00a01 puff B.D. 1\/12 and repeat 6\/12.\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS INHALER.\u00a0\\n\\n2.\u00a0\u00a0Salbutamol\/Ventolin\u00a0Inhaler. 100mcg\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0"
    },
    {
        "num": "299",
        "name": "Seretide Diskus Ventolin Inhaler",
        "line1": "Seretide Diskus Ventolin Inhaler",
        "desc": "1. Seretide Diskus 100mcg\u00a01 puff B.D.\u00a0x 1\/12 and repeat 6\/12\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS INHALER.\\n\\n\\n\\n2.\u00a0Salbutamol\/Ventolin Inhaler\u00a0100mcg\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "298",
        "name": "Seretide Evohaler - Inhaler",
        "line1": "Seretide Evohaler - Inhaler",
        "desc": "Seretide 125 Evohaler\u00a0 2 puffs B.D. x 1\/12and repeat 6\/12.\u00a0\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS INHALER.\u00a0"
    },
    {
        "num": "1",
        "name": "Seretide Evohaler 125 mcg",
        "line1": "Seretide Evohaler",
        "desc": "125mcg\u00a0\u00a01 puff B.D. 1\/12 and repeat 6\/12."
    },
    {
        "num": "308",
        "name": "Sertraline Antidepressant",
        "line1": "Sertraline Antidepressant",
        "desc": "Sertraline 50mg P.O. O.D.\u00a0 x 1\/12 and repeat x 6\/12"
    },
    {
        "num": "331",
        "name": "SIDENA (GENERIC VIAGRA) 25\/50\/100mg Erectile Dysfunction",
        "line1": "SIDENA (GENERIC VIAGRA) 25\/50\/100mg Erectile Dysfunction",
        "desc": "SIDENA (GENERIC VIAGRA) 25\/50\/100mg\\nViagra\/Sildenafil (Sidena or equivalent) 25\/50\/100mg tables. P.O. 4 tablets x 6 [ 24 (maximum) tablets ]\\n\\n1 hour prior to sexual activity to a maximum 1 tablet in any 24 hours.\\nFor further instructions please read the leaflet"
    },
    {
        "num": "188",
        "name": "Silcock's Base Topical",
        "line1": "Silcock's Base Topical",
        "desc": "\u00a0Silcock's Base Use as a soap for cleansing and also as a moisturiser. Dispense 500g tub."
    },
    {
        "num": "336",
        "name": "SILDENAFIL CLONMEL (GENERIC VIAGRA) 25\/50\/100mg Erectile Dysfunction",
        "line1": "SILDENAFIL CLONMEL (GENERIC VIAGRA) 25\/50\/100mg Erectile Dysfunction",
        "desc": "SILDENAFIL CLONMEL (GENERIC VIAGRA) 25\/50\/100mg\\nSildenafil 25\/50\/100mg 4 tablets x 6 [ 24 (maximum) tablets ]\\n\\nPlease check your online account for further instructions or read the leaflet"
    },
    {
        "num": "269",
        "name": "Singulair Montelukast",
        "line1": "Singulair Montelukast",
        "desc": "Singulair (Montelukast) 10mgs 1 nocte P.O\u00a0 x1\/12 repeat x 6\/12.\u00a0\\n"
    },
    {
        "num": "276",
        "name": "Sinusitis Treatment Abx Nasal spray",
        "line1": "Sinusitis Treatment Abx Nasal spray",
        "desc": "1. Doxycycline 100mg P.O B.D x 5\/7\\n\\n2.\u00a0Avamys\u00a0Fluticasone Fuorate 27.5mcg\u00a0Nasal Spray\u00a02 sprays in each nostril twice daily until symptoms are controlled and then reduce to one spray to each nostril mane as maintenance.\u00a0x 1\/12\u00a0\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS NASAL SPRAY."
    },
    {
        "num": "179",
        "name": "Skinoren (Azelaic acid 15%) Acne",
        "line1": "Skinoren (Azelaic acid 15%) Acne",
        "desc": "Skinoren (Azelaic acid 15%). Apply BD to affected areas. Repeat x\u00a06\/12\\n\\n"
    },
    {
        "num": "80",
        "name": "SNRI - Venlablue XL 150mg",
        "line1": "SNRI - Venlablue XL 150mg",
        "desc": "Venlablue XL 150mg, one tablet to be taken daily. 1\/12 and repeat 6\/12\\n"
    },
    {
        "num": "79",
        "name": "SNRI Venlablue XL 75mg",
        "line1": "SNRI Venlablue XL 75mg",
        "desc": "Venlablue XL 75mg, one tablet to be taken daily. 1\/12 and repeat 6\/12\\n\\n"
    },
    {
        "num": "216",
        "name": "Sofradex Ear Drops Abx Steroid",
        "line1": "Sofradex Ear Drops Abx Steroid",
        "desc": "Sofradex Ear Drops\u00a0 2-3\u00a0drops into the affected ear(s) T.I.D x 1\/52\\n"
    },
    {
        "num": "53",
        "name": "Sofradex Eye Drops",
        "line1": "Sofradex Eye Drops",
        "desc": "Sofradex Eye Drops (Framycetin Sulphate 0.5 %w\/v (5mg\/ml), Gramicidin 0.005% w\/v (0.05 mg\/ml), Dexamethasone sodium metasulphobenzoate equivalent to Dexamethasone 0.05% w\/v (0.5 mg\/ml).\\n\\nOne or two drops applied to each affected eye up to six times daily or more frequently if required x maximum 7 days or less if the issue is resolved."
    },
    {
        "num": "76",
        "name": "Solpadeine 15mg\/500mg",
        "line1": "Solpadeine 15mg\/500mg",
        "desc": "Solpadeine 15mg\/500mg PO QDS x 2.52"
    },
    {
        "num": "56",
        "name": "Soolantra",
        "line1": "Soolantra",
        "desc": "Soolantra 10 mg\/g cream ivermectin to be applied to the affected are of the FACE only. Miite 1\/12 and repeat 3\/12\\n\\nOne application on facial skin per day. Apply a pea size amount of the cream to each of the five areas of the face: forehead, chin, nose and each cheek. Then spread the cream as a thin layer across the entire face\\n\\nOnly for use on the skin of the face. Do not use this medicine on other parts of your body, especially not moist body surfaces, e.g. your eyes, your mouth or any mucosa.\\n\\nStieprox\u00ae 15 mg\/g Shampoo (ciclopirox olamine) to be applied to the affected area 2-3 times a week for a total of 4 weeks.\\n\\nSee your online account for more details."
    },
    {
        "num": "173",
        "name": "Soolantra  ivermectin cream Topical",
        "line1": "Soolantra  ivermectin cream Topical",
        "desc": "\u00a0Soolantra Cream 30g Apply once daily to entire face in thin film. Wash hands carefully after use. Dispense 1 tube and repeat x 3"
    },
    {
        "num": "332",
        "name": "SPEDRA 50\/100\/200MG",
        "line1": "SPEDRA 50\/100\/200MG",
        "desc": "SPEDRA 50\/100\/200MG\\nSpedra 50\/100\/200 mg tablets. P.O. 4 tablets x 6 [ 24 (maximum) tablets]\\n\\n15-30 mins prior to sexual activity to a max. of 1 tablet in any 24 hours.\\n\\nFor further instructions please read the leaflet"
    },
    {
        "num": "270",
        "name": "Spedra Avanafil  Erectile dysfunction ED",
        "line1": "Spedra Avanafil  Erectile dysfunction ED",
        "desc": "Spedra (Avanafil) 100mg \u00a0P.O. 1 box x 4 tablets. Repeat x 6 boxes.\\n\\n15-30 mins prior to sexual activity to a\u00a0max. of\u00a01 tablet in any\u00a024 hours."
    },
    {
        "num": "307",
        "name": "Sterimar Nasal Spray",
        "line1": "Sterimar Nasal Spray",
        "desc": "Sterimar Nasal Spray: 1 spray to each nostril P.R.N x 1& repeat x 6\/12\\nIf\u00a0 used with a steroid nasal spray, use the Sterimar spray 5-10 minutes prior to using the steroid nasal\u00a0spray."
    },
    {
        "num": "3",
        "name": "Stieprox 15 mg\/g Shampoo for dandruff and seborrhoeic dermatitis (above 12 years old)",
        "line1": "Stieprox 15 mg\/g Shampoo for dandruff and seborrhoeic dermatitis (above 12 years old)",
        "desc": "Stieprox 15 mg\/g Shampoo ciclopirox olamine.\u00a0Use Stieprox two to three times a week for upto 4 weeks.\\n\\nHow to apply Stieprox 1. Wet your hair. 2. Use enough Stieprox so that the lather covers your scalp, hair and adjacent areas, if affected. 3. Massage the scalp and adjacent areas, if needed, really well using your fingertips. 4. Rinse your scalp and hair thoroughly. 5. Repeat steps 2 to 4."
    },
    {
        "num": "57",
        "name": "Stieprox\u00ae 15 mg\/g Shampoo for scalp",
        "line1": "Stieprox\u00ae 15 mg\/g Shampoo for scalp",
        "desc": "Stieprox\u00ae 15 mg\/g Shampoo (ciclopirox olamine) to be applied to the affected area 2-3 times a week for a total of 4 weeks.\\n\\nSee your online account for more details."
    },
    {
        "num": "85",
        "name": "Sumatriptan tablets (Imigran\/ Sumatran) - 100mg",
        "line1": "Sumatriptan tablets (Imigran\/ Sumatran) - 100mg",
        "desc": "Sumatriptan tablets (Imigran\/ Sumatran) - 100mg\\n\\nOne to be taken at the onset of symptoms and repeat after 2 hours if symptoms are not settling. Dispense x 6 tabs. Repeat x 6\/12."
    },
    {
        "num": "304",
        "name": "Symbicort + Salbutamol Inhaler",
        "line1": "Symbicort + Salbutamol Inhaler",
        "desc": "1. Symbicort Turbohaler\u00a0200\/6mcg\u00a01 puff twice daily\u00a0x 1\/12\u00a0 and repeat x 6\/12\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS INHALER.\\n\\n\\n2.Salbutamol\/Ventolin Inhaler\u00a0100mcg\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "118",
        "name": "Symbicort Turbohaler: 100\/6 booster and Vetollin",
        "line1": "Symbicort Turbohaler: 100\/6 booster and Vetollin",
        "desc": "Symbicort Turbohaler: 100\/6:\u00a0two puffs three times daily for two weeks, two puffs in the morning and evening for two weeks, and then one puff in the morning and evening as maintenance therapy. GAG WITH WATER AFTER USING THIS INHALER AT ALL TIMES. repeat six times, starting in the middle.\\nSalbutamol\/Ventolin\u00a0Inhaler. 100mcg\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "19",
        "name": "Symbicort Turbohaler: 400\/12 mcg and Salbutamol\/Ventolin\u00a0Inhaler",
        "line1": "Symbicort Turbohaler: 400\/12 mcg and Salbutamol\/Ventolin\u00a0Inhaler",
        "desc": "Symbicort Turbohaler: 400\/12 mcg\u00a0 two puffs twice a day x 1\/12 and repeat 6\/12\\n\\nGAG WITH WATER AFTER USING THIS INHALER AT ALL TIMES\\n\\nSalbutamol\/Ventolin\u00a0Inhaler\u00a0100mcg\u00a01-2\u00a0 puffs\u00a0as required x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "144",
        "name": "Tears Naturale eye drops",
        "line1": "Tears Naturale eye drops",
        "desc": "Tears Naturale eye drops, solution (Dextran 70 0.1% w\/v, Hypromellose 0.3% w\/v). 1-2 drops P.R.N, Dispense 1 x 15ml. Repeat x 3."
    },
    {
        "num": "248",
        "name": "Telfast Fexofenadine Antihsitamine",
        "line1": "Telfast Fexofenadine Antihsitamine",
        "desc": "Telfast (Fexofenadine) Specify dose: 120 or 180mg: One P.O.O.D. x 30 repeat 6\/12"
    },
    {
        "num": "263",
        "name": "Terbinafine Antifungal",
        "line1": "Terbinafine Antifungal",
        "desc": "Terbinafine 250mg P.O. O.D. x 1\/12 repeat for 6\/12\\n"
    },
    {
        "num": "70",
        "name": "Terbinafine antifungal (Tinea",
        "line1": "Terbinafine antifungal (Tinea",
        "desc": "Terbinafine cream Topical 1%. To be applied to the affected area 1-2x\/daily for\u00a01 week."
    },
    {
        "num": "264",
        "name": "Terbinafine Cream Antifungal Topical",
        "line1": "Terbinafine Cream Antifungal Topical",
        "desc": "Terbinafine Cream x\u00a030g and repeat x 6 times.\\n\\nMassage into the skin of both feet twice a day for at least a month. Repeat for a further two months if required."
    },
    {
        "num": "110",
        "name": "Tetralysal\/Lymecycline 300mg",
        "line1": "Tetralysal\/Lymecycline 300mg",
        "desc": "Tetralysal\/Lymecycline 300mg P.O O.D x 3\/12\\n\\nUse SPF and avoid strong sun exposure. Avoid pregnancy while using this medication. Take with a glass of water or food"
    },
    {
        "num": "181",
        "name": "Tetralysal\/Lymecycline Acne Abx",
        "line1": "Tetralysal\/Lymecycline Acne Abx",
        "desc": "Tetralysal\/Lymecycline 300mg P.O O.D x 3\/12\\n\\nUse SPF and avoid strong sun exposure. Avoid pregnancy while using this medication. Take with a glass of water or food"
    },
    {
        "num": "141",
        "name": "Thwart topical wart",
        "line1": "Thwart topical wart",
        "desc": "Thwart 26% w\/w Cutaneous Solution. O.D until warts disappear or maximum of 6 weeks . Dispense 10mls."
    },
    {
        "num": "267",
        "name": "Tibolone HRT",
        "line1": "Tibolone HRT",
        "desc": "Tibolone\u00a02.5mg P.O. O.D. x 1\/12 repeat 6\/12\\n"
    },
    {
        "num": "45",
        "name": "Tizanidine 2 mg Tablets MUSCLE SPASM, RELAXANT",
        "line1": "Tizanidine 2 mg Tablets MUSCLE SPASM, RELAXANT",
        "desc": "Tizanidine 2 mg Tablets, one tablet twice a day (every 12 hours) for 5 days\\n\\nFOR DOCTORS!\u00a0Single doses of Tizanidine should not exceed 12mg and the total daily dose should not exceed 36 mg,"
    },
    {
        "num": "14",
        "name": "Topiramate 25 mg for migraine",
        "line1": "Topiramate 25 mg for migraine",
        "desc": "Topiramate 25 mg\u00a0PO \u2013 Take 1 pill at bedtime, once a day\u00a01\/12 and repeat 2\/12"
    },
    {
        "num": "159",
        "name": "Tranexamic Acid menorrhagia",
        "line1": "Tranexamic Acid menorrhagia",
        "desc": "Tranexamic Acid 500mg\u00a0\u00a02-3 tablets T.I.D, Dispense x 50 tablets. Repeat x 2\\n\\nStart after heavy bleeding has started\u00a0for maximum of\u00a04 days"
    },
    {
        "num": "25",
        "name": "Travel Vaccine (Hep A) Harvix for adults",
        "line1": "Travel Vaccine (Hep A) Harvix for adults",
        "desc": "Havrix Monodose Vaccine.\u00a0(Hepatitis A Vaccine (inactivated, adsorbed), 1440 ELISA units\/ 1ml Suspension for injection in a pre-filled syringe)\\n\\nPrimary immunisation consists of a single dose of Havrix Monodose Vaccine\u00a0given intramuscularly.\\n\\nx Mitte single dose"
    },
    {
        "num": "24",
        "name": "Travel Vaccine (Hep A) Harvix for Children\/adolescents (1-15 years)",
        "line1": "Travel Vaccine (Hep A) Harvix for Children\/adolescents (1-15 years)",
        "desc": "Havrix Junior Monodose Vaccine.\u00a0(Hepatitis A Vaccine (Inactivated, Adsorbed). 720 ELISA units\/ 0.5ml Suspension for injection in a pre-filled syringe)\\n\\nPrimary immunisation consists of a single dose of Havrix Junior Monodose vaccine (720 ELISA units\/0.5 ml) given intramuscularly.\\n\\nx Mitte single dose"
    },
    {
        "num": "26",
        "name": "Travel vaccine REVAXIS Suspension for injection in pre-filled syringe Diphtheria, tetanus and poliomyelitis (inactivated) vaccine (adsorbed, reduced antigen(s) content)",
        "line1": "Travel vaccine REVAXIS Suspension for injection in pre-filled syringe Diphtheria, tetanus and poliomyelitis (inactivated) vaccine (adsorbed, reduced antigen(s) content)",
        "desc": "REVAXIS Suspension for injection in pre-filled syringe\u00a0 Dosage:\u00a00.5 ml.\\n\\nDiphtheria, tetanus and poliomyelitis vaccine\\n\\nFor intramuscular injection only. The recommended injection site is the deltoid region. REVAXIS must not be administered by intradermal or intravascular routes."
    },
    {
        "num": "218",
        "name": "Travocort Cream Antifungal Topical",
        "line1": "Travocort Cream Antifungal Topical",
        "desc": "Travocort (Isoconazole\/ Difluocortolone) Cream B.I.D. x 1\/52\u00a0then reduce to\u00a0Nocte x 1\/52 and then alternate nights x 1\/52\u00a0and then stop.\u00a0Apply sparingly to the affected areas and avoid prolonged continuous use."
    },
    {
        "num": "290",
        "name": "Trimethoprim Abx",
        "line1": "Trimethoprim Abx",
        "desc": "Trimethoprim 200mg P.O. B.D.\u00a0 x 3 days.\u00a0\\n\\nAvoid pregnancy when taking this medicine."
    },
    {
        "num": "289",
        "name": "Trimethoprim Paediatric Abx",
        "line1": "Trimethoprim Paediatric Abx",
        "desc": "Trimethoprim 10mg\/ml oral solution. PO.\u00a0CHOOSE\u00a0mg BD for 3 days.\\n"
    },
    {
        "num": "163",
        "name": "Ultraproct ointment Topical  Haemorrhoids",
        "line1": "Ultraproct ointment Topical  Haemorrhoids",
        "desc": "Ultraproct ointment B.D after bowel movement as directed\u00a0 up to 7 days\\n\\n"
    },
    {
        "num": "324",
        "name": "UTI\/Cystitis Macrobid (Nitrofurantoin MR) Abx",
        "line1": "UTI\/Cystitis Macrobid (Nitrofurantoin MR) Abx",
        "desc": "Macrobid (Nitrofurantoin MR) 100mg caps. One P.O. B.D. C.C. Mitte x 3\/7(If Macrobid is not available, then use Macrodantin [Nitrofurantoin SR) 50mg Q.I.D. Mitte x 3\/7 instead)"
    },
    {
        "num": "147",
        "name": "Vagifem HRT PV",
        "line1": "Vagifem HRT PV",
        "desc": "Vagifem 10 micrograms vaginal tablets. Dispense\u00a024 vaginal tablets with applicators.\u00a0\\n\\nInitial dose: One vaginal tablet nocte for two weeks. Maintenance dose: One vaginal tablet twice a week."
    },
    {
        "num": "283",
        "name": "Valtrex Valaciclovir 500mg Antiviral",
        "line1": "Valtrex Valaciclovir 500mg Antiviral",
        "desc": "Valtrex\/Valaciclovir 500mg P.O. B.D.\u00a0 for 5 days. Dispense x 10 tabs.\u00a0Repeat x 4"
    },
    {
        "num": "282",
        "name": "Valtrex Valaciclovir Antiviral For suppression of recurrences",
        "line1": "Valtrex Valaciclovir Antiviral For suppression of recurrences",
        "desc": "Valtrex\/Valaciclovir\u00a0250mg\u00a0B.D PO. Pack of 60. Repeat * 2\\nTreatment should be re-evaluated after 6 months of therapy."
    },
    {
        "num": "281",
        "name": "Valtrex Valaciclovir Antiviral Genital Herpes",
        "line1": "Valtrex Valaciclovir Antiviral Genital Herpes",
        "desc": "Valtrex\/Valaciclovir 500mg P.O. B.D. x 5\/7 days. Dispense x 10 tabs.\u00a0Repeat x 4"
    },
    {
        "num": "171",
        "name": "VANIQA 11.5% CREAM - hirsutism",
        "line1": "VANIQA 11.5% CREAM - hirsutism",
        "desc": "VANIQA 11.5% CREAM.\u00a030g per month. B.D to affected area, Dispense x 3 60g\u00a0tubes for\u00a06-month supply.\\n\\nApply Vaniqa cream to the affected area twice daily, at least eight hours apart. If no improvement after 4 months, discontinue.\\n\\nAvoid pregnancy & breast feeding\u00a0when using this product."
    },
    {
        "num": "33",
        "name": "Ventolin Nebules 5mg\/2.5ml Nebuliser Solution",
        "line1": "Ventolin Nebules 5mg\/2.5ml Nebuliser Solution",
        "desc": "Ventolin Nebules 5mg\/2.5ml Nebuliser Solution\u00a0\\n\\nAdults and adolescents aged 12 years and over: A suitable starting dose of salbutamol by wet inhalation is 2.5 milligrams. This may be increased to 5 milligrams.\u00a0Treatment may be repeated up to four times daily. In adult dosing, up to 40 milligrams per day, can be given under strict medical supervision in hospital for the treatment of severe airways obstruction.\\n\\nPaediatric population For children aged 4 to 11 years: A suitable starting dose of salbutamol by wet inhalation is 2.5 milligrams.\u00a0 This may be increased to 5 milligrams.\u00a0Treatment may be repeated up to four times daily.\\n\\nOther pharmaceutical forms may be more appropriate for administration in children under 4 years old."
    },
    {
        "num": "305",
        "name": "Ventolin Salbutamol Inhaler",
        "line1": "Ventolin Salbutamol Inhaler",
        "desc": "Salbutamol\/Ventolin Inhaler. 100mcg\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "327",
        "name": "Ventollin and Becotide Inhaler",
        "line1": "Ventollin and Becotide Inhaler",
        "desc": "1.\u00a0\u00a0Becotide 100 mcg\u00a0inhaler\u00a0 1 puff B.D. 1\/12 and repeat 6\/12.\\n\\nALWAYS GARGLE WITH WATER AFTER USING THIS INHALER.\\n\\n\\n\\n2.\u00a0\u00a0Salbutamol\/Ventolin\u00a0Inhaler. 100mcg\u00a01\u00a0puffs P.R.N O.P.x 1\u00a0and repeat x 2\u00a0\\n\\nTHIS INHALER\u00a0SHOULD NOT BE USED FOR REGULAR MAINTENANCE THERAPY. MORE THAN ONCE WEEKLY USEAGE INDICATES POOR ASTHMA CONTROL."
    },
    {
        "num": "75",
        "name": "Versatis\u00ae 5% medicated plaster (lidocaine)",
        "line1": "Versatis\u00ae 5% medicated plaster (lidocaine)",
        "desc": "Versatis\u00ae 5% medicated plaster (lidocaine) to be applied topically to the affected area x 1\/52\\n\\nThe usual daily dose is to use between one and three plasters of the size of the painful areas of your skin. Versatis may be cut into smaller pieces to fit the affected area. You should not use more than 3 plasters at the same time. The plasters should be removed after 12 hours of use, so that you have a 12 hour period with no plaster."
    },
    {
        "num": "335",
        "name": "VIAGRA 25\/50\/100mg Erectile Dysfunction",
        "line1": "VIAGRA 25\/50\/100mg Erectile Dysfunction",
        "desc": "VIAGRA 25\/50\/100mg\\nViagra 25\/50\/100mg 4 tablets x 6 [ 24 (maximum) tablets ]\\n\\nFor further instructions please read the leaflet"
    },
    {
        "num": "197",
        "name": "Vibramycin\/Doxycycline Malaria Prophylaxis",
        "line1": "Vibramycin\/Doxycycline Malaria Prophylaxis",
        "desc": "Vibramycin\/Doxycycline 100mg Caps. One P.O. O.D.\u00a0 x \u00a0(SPECIFY NO OF DAYS OF TREATMENT)\u00a0caps.\\n\\nAdvice for patients\\n\\nStart the\u00a0tablets 24 hours prior to entering malaria zone and continue for the duration of your stay and for 28\u00a0days after leaving the danger area.\\nAvoid pregnancy and breastfeeding when taking this medicine.\u00a0"
    },
    {
        "num": "128",
        "name": "Vimovo NSAID PPI Analgesia",
        "line1": "Vimovo NSAID PPI Analgesia",
        "desc": "Vimovo 500\/20mg x 1\/52, one tablet to be taken every 12 hours fpr one week and\u00a0repeat x 2"
    },
    {
        "num": "16",
        "name": "Violite\u00a0tablets",
        "line1": "Violite\u00a0tablets",
        "desc": "Violite\u00a0tablets [ 126 Tablets ]\\nDirections to use : One tablet daily for 21 days.\\n\\nPlease check your online account for further instructions or read the leaflet"
    },
    {
        "num": "321",
        "name": "Viral gastroentritis",
        "line1": "Viral gastroentritis",
        "desc": "Imodium 2mg PO OD QDS 5\/7\\n\\nMetaclopromide 10mg PO TDS 5\/7\\n\\nBuscopan 10mg TDS PO for 5\/7"
    },
    {
        "num": "95",
        "name": "Vulvovaginal candidiasis or Vaginal thrush",
        "line1": "Vulvovaginal candidiasis or Vaginal thrush",
        "desc": "Cloritomazole (Canestan) 500mg pessary Single dose\\n\\nInsert the pessary using applicator. Use of an applicator is not recommended during pregnancy. Latex condoms and diaphragms ca be damaged by vaginal creams and pessaries, extra precautions are advised."
    },
    {
        "num": "190",
        "name": "Warticon Cream Podophyllotoxin Topical",
        "line1": "Warticon Cream Podophyllotoxin Topical",
        "desc": "Warticon Cream. B.D for 3 days, do not apply for next 4 days. Restart cycles until warts disappear.\u00a0 Dispense 1 tube x 1 repeat."
    },
    {
        "num": "349",
        "name": "Xenical (Orlistat) 120mg [252 capsules, 12 week course] [ 252 Capsules ]",
        "line1": "Xenical (Orlistat) 120mg [252 capsules, 12 week course] [ 252 Capsules ]",
        "desc": "Xenical (Orlistat) 120mg [252 capsules, 12 week course] [ 252 Capsules ]\\nDosage:\\n\\nTake one capsule with water three times a day immediately before, during or up to an hour after each main meal.\\n\\nFor further instructions please read the leaflet"
    },
    {
        "num": "251",
        "name": "Xyzal Levocetirizine Antihistamine",
        "line1": "Xyzal Levocetirizine Antihistamine",
        "desc": "Xyzal (Levocetirizine) 5mg. P.O. O.D. x 1\/12, repeat 6\/12"
    },
    {
        "num": "326",
        "name": "Yasmin",
        "line1": "Yasmin",
        "desc": "Yasmin (0.030 mg ethinylestradiol and 3 mg drospirenone)\\nThe tablets must be taken every day at about the same time, if necessary with a little liquid, in the order shown on the blister pack. One tablet is to be taken daily for 21 consecutive days. Every subsequent blister pack is started after a 7-day tablet-free interval\u00a0 during which time a withdrawal bleeding usually occurs.\u00a0 Mitte\u00a0x 1\/12\u00a0& Repeat for 6\/12.\\nFurther instructions are in your Patient Record."
    },
    {
        "num": "337",
        "name": "Yasminelle tablets [ 126 Tablets ]",
        "line1": "Yasminelle tablets [ 126 Tablets ]",
        "desc": "YASMINELLE\\nYasminelle tablets [ 126 Tablets ]\\n\\nDirections to use : One tablet daily for 21 days. Further instructions are in your Patient Record."
    },
    {
        "num": "116",
        "name": "Yaz",
        "line1": "Yaz",
        "desc": "YAZ\\nYaz tablets\u00a0[ 168 Tablets ]\\n\\nDirections to use : One tablet daily for 28 days."
    },
    {
        "num": "172",
        "name": "Zindaclin  Abx Topical Acne",
        "line1": "Zindaclin  Abx Topical Acne",
        "desc": "Zindaclin 1%\u00a0 30g\u00a0Apply thin film daily for no longer than 3 months.\u00a0Dispense 1 tube and repeat x 3"
    },
    {
        "num": "10",
        "name": "Zineryt\u00ae 40mg\/12mg For Acne",
        "line1": "Zineryt\u00ae 40mg\/12mg For Acne",
        "desc": "Zineryt\u00ae 40mg\/12mg per ml Powder and Solvent for Cutaneous Solution (erythromycin and zinc acetate dihydrate) 1\/12 and repeat 3\/12\\n\\nshould be applied all over the affected area and the surrounding skin twice a day\u00a0"
    },
    {
        "num": "109",
        "name": "Zoely",
        "line1": "Zoely",
        "desc": "Zoely tablets [ 168 Tablets ]\\n\\nDirections to use: One tablet daily for 24 days, followed by i inactive tablet daily for 4 days; subsequent courses repeated without interval.\\n\\nPlease check your online account for further instructions or read the leaflet."
    },
    {
        "num": "208",
        "name": "Zomig Rapimelt Migraine",
        "line1": "Zomig Rapimelt Migraine",
        "desc": "Zomig Rapimelt Tabs. One to be taken at the onset of symptoms and repeat after 2 hours if symptoms are not settling. Dispense x 6 tabs. Repeat x 6\/12."
    },
    {
        "num": "280",
        "name": "Zovirax Aciclovir Antiviral",
        "line1": "Zovirax Aciclovir Antiviral",
        "desc": "Zovirax\/Aciclovir 200mg PO T.I.D x 5\/7 days.\\n"
    },
    {
        "num": "278",
        "name": "Zovirax Aciclovir Antiviral Genital Herpes",
        "line1": "Zovirax Aciclovir Antiviral Genital Herpes",
        "desc": "Zovirax Aciclovir 400mg PO T.I.D x 5\/7 days.\\n"
    },
    {
        "num": "235",
        "name": "Zovirax Suspension Paediatrics Antiviral",
        "line1": "Zovirax Suspension Paediatrics Antiviral",
        "desc": "Zovirax Suspension:\u00a0Specify strength and age:\u00a0200mg\/5ml or 400mg \/5ml.\\n\\nDosing: age <2>\\n\\n2-6 years: 400mg \u00a0Q.I.D.\\n\\n>6 years:\u00a0800mg Q.I.D.\u00a0\\n\\nSpecify quantity to be dispensed 125ml or 100ml (Double strength)"
    },
    {
        "num": "316",
        "name": "Zyban 150 mg prolonged release tablets.\u00a0smoking cessation",
        "line1": "Zyban 150 mg prolonged release tablets.\u00a0smoking cessation",
        "desc": "Zyban 150 mg prolonged release tablets.\u00a0The initial dose is 150\u00a0mg to be taken daily for six days, increasing on day seven to 150\u00a0mg twice daily.\u00a0Mitte * 120 tablets.\u00a0Started while still smoking and a target stop date set within the first two weeks of treatment, preferably in the second week.\u00a0\u00a0There should be an interval of at least 8 hours between doses.\u00a0If at seven weeks no effect is seen, treatment should be discontinued.\u00a0\\n\\nFor further instructions please read the leaflet"
    }
];