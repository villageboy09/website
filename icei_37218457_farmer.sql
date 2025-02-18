-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql102.iceiy.com
-- Generation Time: Feb 18, 2025 at 11:25 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icei_37218457_farmer`
--

-- --------------------------------------------------------

--
-- Table structure for table `AgronomyDatabase`
--

CREATE TABLE `AgronomyDatabase` (
  `Crop` varchar(255) DEFAULT NULL,
  `MajorPests1` text DEFAULT NULL,
  `MajorDiseases1` text DEFAULT NULL,
  `MajorWeeds1` text DEFAULT NULL,
  `DiseaseControlMeasures1` text DEFAULT NULL,
  `PestControlMeasures1` text DEFAULT NULL,
  `WeedControlMeasures1` text DEFAULT NULL,
  `MajorPests2` text DEFAULT NULL,
  `MajorDiseases2` text DEFAULT NULL,
  `MajorWeeds2` text DEFAULT NULL,
  `DiseaseControlMeasures2` text DEFAULT NULL,
  `PestControlMeasures2` text DEFAULT NULL,
  `WeedControlMeasures2` text DEFAULT NULL,
  `MajorPests3` text DEFAULT NULL,
  `MajorDiseases3` text DEFAULT NULL,
  `MajorWeeds3` text DEFAULT NULL,
  `DiseaseControlMeasures3` text DEFAULT NULL,
  `PestControlMeasures3` text DEFAULT NULL,
  `WeedControlMeasures3` text DEFAULT NULL,
  `ShortDurationVarieties` text DEFAULT NULL,
  `MediumDurationVarieties` text DEFAULT NULL,
  `LongDurationVarieties` text DEFAULT NULL,
  `KharifSowingPhaseTemperature` varchar(50) DEFAULT NULL,
  `KharifSowingPhaseHumidity` varchar(50) DEFAULT NULL,
  `KharifGrowthPhaseTemperature` varchar(50) DEFAULT NULL,
  `KharifGrowthPhaseHumidity` varchar(50) DEFAULT NULL,
  `KharifFloweringPhaseTemperature` varchar(50) DEFAULT NULL,
  `KharifFloweringPhaseHumidity` varchar(50) DEFAULT NULL,
  `KharifMaturityPhaseTemperature` varchar(50) DEFAULT NULL,
  `KharifMaturityPhaseHumidity` varchar(50) DEFAULT NULL,
  `RabiSowingPhaseTemperature` varchar(50) DEFAULT NULL,
  `RabiSowingPhaseHumidity` varchar(50) DEFAULT NULL,
  `RabiGrowthPhaseTemperature` varchar(50) DEFAULT NULL,
  `RabiGrowthPhaseHumidity` varchar(50) DEFAULT NULL,
  `RabiFloweringPhaseTemperature` varchar(50) DEFAULT NULL,
  `RabiFloweringPhaseHumidity` varchar(50) DEFAULT NULL,
  `RabiMaturityPhaseTemperature` varchar(50) DEFAULT NULL,
  `RabiMaturityPhaseHumidity` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `AgronomyDatabase`
--

INSERT INTO `AgronomyDatabase` (`Crop`, `MajorPests1`, `MajorDiseases1`, `MajorWeeds1`, `DiseaseControlMeasures1`, `PestControlMeasures1`, `WeedControlMeasures1`, `MajorPests2`, `MajorDiseases2`, `MajorWeeds2`, `DiseaseControlMeasures2`, `PestControlMeasures2`, `WeedControlMeasures2`, `MajorPests3`, `MajorDiseases3`, `MajorWeeds3`, `DiseaseControlMeasures3`, `PestControlMeasures3`, `WeedControlMeasures3`, `ShortDurationVarieties`, `MediumDurationVarieties`, `LongDurationVarieties`, `KharifSowingPhaseTemperature`, `KharifSowingPhaseHumidity`, `KharifGrowthPhaseTemperature`, `KharifGrowthPhaseHumidity`, `KharifFloweringPhaseTemperature`, `KharifFloweringPhaseHumidity`, `KharifMaturityPhaseTemperature`, `KharifMaturityPhaseHumidity`, `RabiSowingPhaseTemperature`, `RabiSowingPhaseHumidity`, `RabiGrowthPhaseTemperature`, `RabiGrowthPhaseHumidity`, `RabiFloweringPhaseTemperature`, `RabiFloweringPhaseHumidity`, `RabiMaturityPhaseTemperature`, `RabiMaturityPhaseHumidity`) VALUES
('Rice', 'Rice stem borer', 'Blast', 'Barnyard grass', 'Tricyclazole 75 WP @ 0.6g/l for blast', 'Chlorantraniliprole 0.4 ml/l for stem borer', 'Pretilachlor @ 500 ml/acre as pre-emergence', 'Leaf folder', 'Sheath blight', 'Eclipta', 'Carbendazim 50 WP @ 500g/acre for sheath blight', 'Lambda-cyhalothrin 1 ml/l for leaf folder', 'Cyhalofop-butyl @ 80 ml/acre for grass weeds', 'Brown plant hopper', 'Bacterial blight', 'Sedge weeds', 'Streptomycin sulphate @ 200g/acre for bacterial leaf blight', 'Imidacloprid 17.8 SL @ 50ml/acre for brown plant hopper', NULL, 'Low: 75:50:50 NPK kg/acre', 'Medium: 120:40:40 NPK kg/acre', 'Long: 150:50:50 NPK kg/acre', '25-30°C', '70-80%', '28-32°C', '80-90%', '30-35°C', '70-85%', '25-30°C', '60-70%', '20-25°C', '60-70%', '22-28°C', '70-80%', '25-30°C', '65-75%', '20-25°C', '50-60%');

-- --------------------------------------------------------

--
-- Table structure for table `AudioResponses`
--

CREATE TABLE `AudioResponses` (
  `id` int(11) NOT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `audio_path` varchar(255) DEFAULT NULL,
  `text_summary` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `CropsData`
--

CREATE TABLE `CropsData` (
  `CropID` int(11) NOT NULL,
  `CropName` varchar(100) NOT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `unique_pin` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `CropsData`
--

INSERT INTO `CropsData` (`CropID`, `CropName`, `ImageURL`, `unique_pin`) VALUES
(1, 'Tomato', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Tomato_je.jpg/640px-Tomato_je.jpg', '8783'),
(2, 'Potato', 'https://blog.agribegri.com/public/blog_images/potato-growing-tips-ideas-secrets-and-techniques-600x400.png', '8783'),
(3, 'Corn', 'https://www.shutterstock.com/image-photo/corn-cobs-plantation-field-600nw-2219335147.jpg', '8783'),
(4, 'Rice', 'https://cdn.britannica.com/89/140889-050-EC3F00BF/Ripening-heads-rice-Oryza-sativa.jpg', '9038'),
(5, 'Groundnut', 'https://cdn.britannica.com/93/164793-050-218E7B86/peanut-plant-legumes.jpg', '9038'),
(6, 'Maize', 'https://www.shutterstock.com/image-photo/corn-cobs-plantation-field-600nw-2219335147.jpg', '9038'),
(7, 'Sorghum', 'https://cdn.britannica.com/21/136021-050-FA97E7C7/Sorghum.jpg', '9038'),
(8, 'Pearl Millet', 'https://i.pinimg.com/736x/82/21/49/822149277ef0e90f99c9550bd730200a.jpg', '9038');

-- --------------------------------------------------------

--
-- Table structure for table `DiseaseProducts`
--

CREATE TABLE `DiseaseProducts` (
  `ProductID` int(11) NOT NULL,
  `DiseaseID` int(11) DEFAULT NULL,
  `CropID` int(11) DEFAULT NULL,
  `ProductName` varchar(100) DEFAULT NULL,
  `ProductURL` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `DiseaseProducts`
--

INSERT INTO `DiseaseProducts` (`ProductID`, `DiseaseID`, `CropID`, `ProductName`, `ProductURL`) VALUES
(3, 1, 1, 'Mancozeb', 'https://www.agriplexindia.com/cdn/shop/files/NewProject_67.jpg'),
(4, 1, 1, 'Chlorothalonil', 'https://cdn.shopify.com/s/files/1/0722/2059/files/Blight_LahariPeddiReddy.png'),
(5, 4, 1, 'Azoxystrobin', 'https://www.katyayaniorganics.com/wp-content/uploads/2022/06/Azoxy-1.png'),
(6, 2, 2, 'Sulfur Dust', 'https://files.plytix.com/api/v1.1/file/public_files/pim/assets/43/37/8d/5e/5e8d3743202d9eba64d3af60/images/fb/1e/dc/63/63dc1efbbd5bcbdd3c553ef4/141_Front.jpg'),
(7, 6, 2, 'Quintozene', 'https://5.imimg.com/data5/SELLER/Default/2022/12/SZ/SO/TC/54373617/quintozene-500x500.jpg'),
(8, 2, 2, 'Propiconazole', 'https://www.heranba.co.in/wp-content/uploads/2022/06/PROPIZOLE.jpg'),
(9, 7, 3, 'Tebuconazole', 'https://static.agrostar.in/static/AGS-CP-1026_1.jpg'),
(10, 7, 3, 'Pyraclostrobin', 'https://static.agrostar.in/static/AGS-CP-994_1.jpg'),
(11, 14, 4, 'Tricyclazole', 'https://5.imimg.com/data5/SELLER/Default/2024/1/378855169/RX/GT/IJ/47882562/tricyclazole-75-wp-fungicide-120gm-pouch.jpg'),
(12, 14, 4, 'Isoprothiolane', 'https://agribegri.com/productimage/0b9aecce9f11ebee087946b389f655c0-09-09-23-12-01-58.webp'),
(13, 15, 4, 'Streptocycline', 'https://5.imimg.com/data5/SELLER/Default/2023/8/331775419/DU/WH/BA/113625632/6gm-streptocycline-agriculture-pesticides.jpg'),
(14, 16, 4, 'Hexaconazole', 'https://agribegri.com/productimage/f0a9841ec733108d57cafe3b7a745a1b-03-06-22-01-10-34.webp'),
(15, 17, 5, 'Carbendazim', 'https://image.made-in-china.com/202f0j00vIMkheULbBzP/Agrochemicals-Powder-Systemic-Fungicide-Carbendazim-50-Wp.jpg'),
(16, 18, 5, 'Chlorothalonil', 'https://cdn.dotpe.in/longtail/store-items/6792607/K4WkLgnV.png'),
(17, 19, 5, 'Tebuconazole', 'https://static.agrostar.in/static/AGS-CP-1026_1.jpg'),
(18, 17, 5, 'Mancozeb', 'https://www.agriplexindia.com/cdn/shop/files/NewProject_67.jpg'),
(19, 20, 6, 'Pyraclostrobin', 'https://static.agrostar.in/static/AGS-CP-994_1.jpg'),
(20, 21, 6, 'Azoxystrobin', 'https://www.katyayaniorganics.com/wp-content/uploads/2022/06/Azoxy-1.png'),
(21, 22, 6, 'Propiconazole', 'https://www.heranba.co.in/wp-content/uploads/2022/06/PROPIZOLE.jpg'),
(22, 20, 6, 'Tebuconazole', 'https://static.agrostar.in/static/AGS-CP-1026_1.jpg'),
(23, 23, 7, 'Thiophanate Methyl', 'https://www.albaugh.com/images/indialibraries/productimages/thime-packshot-new.png'),
(24, 24, 7, 'Thiram', 'https://www.chinapesticidefactory.com/uploads/202025238/thiram-95-tc-50-wp-cas-no-137-26-806057092050.jpg'),
(25, 25, 7, 'Carbendazim', 'https://www.chinapesticidefactory.com/uploads/202025238/thiram-95-tc-50-wp-cas-no-137-26-806057092050.jpg'),
(26, 23, 7, 'Mancozeb', 'https://www.agriplexindia.com/cdn/shop/files/NewProject_67.jpg'),
(27, 26, 8, 'Metalaxyl', 'https://5.imimg.com/data5/SELLER/Default/2023/3/296276603/LR/AH/IN/119840698/metaxyl-metalaxyl-35-w-s-.jpeg'),
(28, 27, 8, 'Copper Oxychloride', 'https://easy2agri.in/cdn/shop/files/1.jpg'),
(29, 28, 8, 'Carboxin', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTgBmyoZF4cxYnXNmbSr3q2_wvU7g29RtvMA&s'),
(30, 26, 8, 'Mancozeb', 'https://aljayplantingdreams.com/wp-content/uploads/2017/04/Mancozeb-web.png');

-- --------------------------------------------------------

--
-- Table structure for table `Diseases`
--

CREATE TABLE `Diseases` (
  `DiseaseID` int(11) NOT NULL,
  `CropID` int(11) DEFAULT NULL,
  `DiseaseName` varchar(100) DEFAULT NULL,
  `ControlMeasures` text DEFAULT NULL,
  `ImageUrl` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Diseases`
--

INSERT INTO `Diseases` (`DiseaseID`, `CropID`, `DiseaseName`, `ControlMeasures`, `ImageUrl`) VALUES
(1, 1, 'Late Blight', 'Use fungicide sprays and plant resistant varieties.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2W_OTEeGkN1Uhux2nXQbwfHTU3GAryEBBwg&s'),
(2, 2, 'Powdery Mildew', 'Apply sulfur-based fungicides and practice crop rotation.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-Gb0rq6-Tdd3CpYu1PwM0HmLRTWYdQdaW5Q&s'),
(15, 4, 'Bacterial Leaf Blight', 'Plant resistant varieties and maintain good field drainage', 'http://www.knowledgebank.irri.org/images/stories/bacterial-leaf-blight-1.JPG'),
(4, 1, 'Early Blight', NULL, 'https://www.apsnet.org/edcenter/disandpath/fungalasco/pdlessons/PublishingImages/PotatoTomato01sm.jpg'),
(6, 2, 'Potato Scab', NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/Streptomyces_Scabies.jpg/640px-Streptomyces_Scabies.jpg'),
(7, 3, 'Corn Rust', NULL, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRR1_XnT2iiDTumJ7BPO4hX8_oM0EmmufWM8A&s'),
(8, 1, 'Fusarium Wilt', 'Rotate crops and use resistant varieties.', 'https://www.gardenanswers.com/wp-content/uploads/2016/03/5560733500702720.jpeg'),
(9, 1, 'Black Spot', 'Apply fungicides and improve air circulation.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy50X8IibEEHLvqjEOn8DJrmxjZjpaxQ6mYNoBpqa-Jil1RClcCEdZiQIIuhImEROUqA4&usqp=CAU'),
(10, 1, 'Downy Mildew', 'Use resistant varieties and apply fungicides.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRILFBAMu7siK-qbbr6wMux8fGDWhn52nB_5A&s'),
(11, 1, 'Sclerotinia Blight', 'Remove infected plant debris and apply fungicides.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/Sclerotinia_sclerotiorum.jpg/640px-Sclerotinia_sclerotiorum.jpg'),
(12, 1, 'Anthracnose', 'Use resistant cultivars and apply appropriate fungicides.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSeCEQYBseXoyWmrePAP0_773eRoZVH8GaJGg&s'),
(13, 1, 'Leaf Spot', 'Practice crop rotation and apply fungicides as needed.', 'https://cdn.mos.cms.futurecdn.net/FetkYJQL4n7taBqjiHSiQ9.jpg'),
(14, 4, 'Rice Blast', 'Use resistant varieties and apply fungicides', 'http://www.knowledgebank.irri.org/images/stories/blast-leaf-4.jpg'),
(16, 4, 'Sheath Blight', 'Reduce plant density and apply fungicides', 'http://www.knowledgebank.irri.org/images/stories/sheath-blight-2.jpg'),
(17, 5, 'Early Leaf Spot', 'Apply fungicides and practice crop rotation', 'https://content.ces.ncsu.edu/media/images/IMG_0976_2.jpeg'),
(18, 5, 'Late Leaf Spot', 'Use resistant varieties and apply fungicides', 'https://barmac.com.au/wp-content/uploads/sites/3/2016/06/late-leaf-spot-peanut.jpg'),
(19, 5, 'Rust', 'Apply fungicides and maintain proper spacing', 'http://eagri.org/eagri50/PATH272/lecture09/004_clip_image002.jpg'),
(20, 6, 'Northern Corn Leaf Blight', 'Plant resistant hybrids and rotate crops', 'https://extension.umn.edu/sites/extension.umn.edu/files/northernleafblight2_600px.jpg'),
(21, 6, 'Southern Corn Leaf Blight', 'Use resistant varieties and practice crop rotation', 'https://cropprotectionnetwork.org/image?s=%2Fimg%2Fhttp%2Fgeneral%2Fsouthern-corn-leaf-blight-Grau.jpg%2F5421484c7ffa74b6c26b2a6e49acb7e4.jpg&h=0&w=316&fit=contain'),
(22, 6, 'Gray Leaf Spot', 'Rotate crops and apply fungicides when needed', 'https://cropprotectionnetwork.org/image?s=%2Fimg%2Fhttp%2Fgeneral%2FGray-leaf-spot-Daren-Mueller-9.jpg%2F3ca245b14bfe68fd6820901318dd6e8d.jpg&h=256&w=316&fit=cover'),
(23, 7, 'Anthracnose', 'Use resistant hybrids and practice crop rotation', 'https://www.researchgate.net/publication/320419432/figure/fig1/AS:551087959744512@1508401016222/Anthracnose-symptoms-on-sorghum-leaf.png'),
(24, 7, 'Grain Mold', 'Plant at appropriate times and use resistant varieties', 'https://lh4.googleusercontent.com/proxy/3rJH0vHS9o0dDTLLDLumpvPDRQo8N8ajoPxQm9bxffpMj78F5snC7PIUh56IHVudGtKjzqOu1z8vxD9KIZhppkkdRHM2corxBP4UFAlvRAEzEl4'),
(25, 7, 'Charcoal Rot', 'Maintain optimal soil moisture and use resistant varieties', 'https://pestoscope.com/wp-content/uploads/2020/05/Sorghum_Charcoal-rot_3.jpg'),
(26, 8, 'Downy Mildew', 'Use resistant varieties and treat seeds with fungicides', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjt9X-Ts4hUkB5nToza1G-L_ZJtNDOIPPrtQ&s'),
(27, 8, 'Ergot', 'Remove infected plants and use disease-free seeds', 'https://plantwiseplusknowledgebank.org/cms/10.1079/pwkb.species.13788/asset/b3169ba6-8c34-4eda-8c83-237c027e68d7/assets/graphic/clavfu01.jpeg'),
(28, 8, 'Smut', 'Use certified seeds and treat seeds with fungicides', 'https://www.cabidigitallibrary.org/cms/10.1079/cabicompendium.54145/asset/97e614f7-2ff2-4b25-a206-299882ec92a6/assets/graphic/pemil18a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unique_pin` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `name`, `unique_pin`, `created_at`, `profile_picture`) VALUES
(1, 'Dhanunjay', '8783', '2024-09-01 06:32:56', 'https://img.freepik.com/premium-photo/young-indian-farmer-standing-green-pigeon-pea-agriculture-field_960396-611359.jpg?semt=ais_hybrid'),
(2, 'Sita Devi', '9038', '2024-09-01 06:32:56', 'https://img.freepik.com/premium-photo/old-woman-field-corn_1277069-4046.jpg'),
(3, 'Ramesh Kumar', '1234', '2024-11-14 08:59:21', 'https://example.com/farmer-ramesh.jpg'),
(4, 'Sita Devi', '5678', '2024-11-14 08:59:21', 'https://example.com/farmer-sita.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `PestProducts`
--

CREATE TABLE `PestProducts` (
  `ProductID` int(11) NOT NULL,
  `PestID` int(11) DEFAULT NULL,
  `CropID` int(11) DEFAULT NULL,
  `ProductName` varchar(100) DEFAULT NULL,
  `ProductURL` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `PestProducts`
--

INSERT INTO `PestProducts` (`ProductID`, `PestID`, `CropID`, `ProductName`, `ProductURL`) VALUES
(7, 2, 2, 'Beauveria bassiana', 'https://www.katyayaniorganics.com/wp-content/uploads/2022/06/1_c5471a25-9f88-41c3-879b-49f420240ed4.webp'),
(6, 2, 2, 'Carbaryl 50WP', 'https://image.made-in-china.com/2f0j00ZdmhyNpWiqbI/Hot-Sales-Pesticide-Carbaryl-85-Wp-Carbaryl-50-Insecticide-Carbaryl-Insecticida.jpg'),
(5, 2, 2, 'Spinosad Organic', 'https://m.media-amazon.com/images/I/712T9MmxChL.jpg'),
(2, 1, 1, 'Insecticidal Soap Pro', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxSOy_pos2Hoks7lYIfOhLt6jb4pQUXWisTw&s'),
(3, 1, 1, 'PyrethrumMax', 'https://5.imimg.com/data5/SELLER/Default/2024/2/385858927/PB/QV/IK/44099956/pyrethrum-extract-500x500.png'),
(4, 1, 1, 'Malathion 57EC', 'https://aljayplantingdreams.com/wp-content/uploads/2017/04/malathion-600x419.jpg'),
(1, 1, 1, 'Neem Oil Plus', 'https://cdn.zeptonow.com/production///tr:w-640,ar-490-490,pr-true,f-auto,q-80/cms/product_variant/56fdff42-2205-4e46-9355-448083496c8a.jpeg'),
(8, 2, 2, 'Azadirachtin EC', 'https://cdn.shopify.com/s/files/1/0722/2059/products/1fr.webp'),
(9, 3, 3, 'Bacillus thuringiensis', 'https://5.imimg.com/data5/SELLER/Default/2023/2/CE/IN/IF/108900452/bacillus-thuringiensis.jpg'),
(10, 3, 3, 'Lambda-cyhalothrin', 'https://5.imimg.com/data5/SELLER/Default/2022/6/FA/KX/IH/1756737/lambda-cyhalothrin-pesticide.jpg'),
(11, 3, 3, 'Chlorantraniliprole', 'https://agribegri.com/productimage/38dcdf341f797615dbe2161090f65b17-05-17-23-13-59-35.webp'),
(12, 3, 3, 'Methomyl 40SP', 'https://www.engebiotech.com/uploads/METHOMYL-SP1.jpg'),
(13, 4, 4, 'Buprofezin 25SC', 'https://agroshopy.com/image/cache/catalog/APPL-500x500.png'),
(14, 4, 4, 'Imidacloprid 17.8SL', 'https://static.agrostar.in/static/AGS-CP-1235_1.jpg'),
(15, 4, 4, 'Pymetrozine 50WG', 'https://inputs.kalgudi.com/data/p_images/1568019818173.jpeg'),
(16, 4, 4, 'Thiamethoxam 25WG', 'https://www.katyayaniorganics.com/wp-content/uploads/2022/06/thioxam-768x902-1.png'),
(17, 5, 4, 'Cartap Hydrochloride', 'https://5.imimg.com/data5/SELLER/Default/2023/8/337178508/FE/XK/VF/30832115/cartap-hydrochloride-4.jpg'),
(18, 5, 4, 'Chlorpyrifos 20EC', 'https://www.katyayaniorganics.com/wp-content/uploads/2022/06/CHLORO-20-resize.jpg'),
(19, 5, 4, 'Flubendiamide 39.35SC', 'https://static.agrostar.in/static/AGS-CP-766_1.jpg'),
(20, 5, 4, 'Fipronil 5SC', 'https://cdn.shopify.com/s/files/1/0722/2059/files/Untitleddesign_7__AkanshaSingh1_1.png'),
(21, 6, 4, 'Cypermethrin 25EC', 'https://www.dhanuka.com/storage/products/July2022/NJcIqK8dM0itZyg65rr5.png'),
(22, 6, 4, 'Deltamethrin 2.8EC', 'https://static.agrostar.in/static/AGS-CP-1316_1.jpg'),
(23, 6, 4, 'Acephate 75SP', 'https://5.imimg.com/data5/SELLER/Default/2024/5/417255649/SW/OU/UY/111070181/1-kg-acephate-75-sp-insecticide-500x500.jpeg'),
(24, 6, 4, 'Quinalphos 25EC', 'https://static.agrostar.in/static/AGS-CP-1050_1.jpg'),
(25, 7, 4, 'Carbofuran 3G', 'https://5.imimg.com/data5/SELLER/Default/2022/11/LR/YM/IY/79851997/21.jpg'),
(26, 7, 4, 'Phorate 10G', 'https://5.imimg.com/data5/SELLER/Default/2022/4/ME/HS/QX/149046435/fugatox-10g-insecticide-500x500.jpg'),
(27, 7, 4, 'Diazinon 10G', 'https://tanismart.com/wp-content/uploads/2018/06/PicsArt_06-06-02.14.37.jpg'),
(28, 7, 4, 'Phosphamidon 40SL', 'https://www.napanta.com/app-img/product/swal_starmidon.png'),
(29, 8, 5, 'Emamectin Benzoate 5SG', 'https://static.agrostar.in/static/AGS-CP-731_1.jpg'),
(30, 8, 5, 'Indoxacarb 14.5SC', 'https://5.imimg.com/data5/SELLER/Default/2022/1/KW/QR/IC/14575928/indocarb-indoxacarb-14-5-sc--500x500.jpg'),
(31, 8, 5, 'Profenofos 50EC', 'https://rythuagro.in/wp-content/uploads/2024/10/Profen.png'),
(32, 8, 5, 'Thiodicarb 75WP', 'https://5.imimg.com/data5/SELLER/Default/2022/12/EO/UG/CG/54373617/thiodicarb-75-wp.jpg'),
(33, 9, 5, 'Chlorpyriphos 20EC', 'https://farmmate.in/cdn/shop/files/Terminatorchlorpyriphos20whitebottle.png'),
(34, 9, 5, 'Phorate 10G', 'https://5.imimg.com/data5/SELLER/Default/2022/3/UW/YC/FX/144868002/04b6bee5-de68-4a2c-97ed-91b860503309.jpg'),
(35, 9, 5, 'Quinalphos 5G', 'https://m.media-amazon.com/images/I/51MwfB47CVS.jpg'),
(36, 9, 5, 'Carbofuran 3G', 'https://5.imimg.com/data5/SELLER/Default/2022/11/LR/YM/IY/79851997/21.jpg'),
(37, 10, 5, 'Cyromazine 75WP', 'https://5.imimg.com/data5/SELLER/Default/2024/7/435142342/TB/YN/FM/54373617/cyromazine-75wp.jpeg'),
(38, 10, 5, 'Abamectin 1.9EC', 'https://agribegri.com/admin/images/prod_image/16300111511709544476.webp'),
(39, 10, 5, 'Spinosad 45SC', 'https://static.agrostar.in/static/AGS-CP-254_1.jpg'),
(40, 10, 5, 'Cartap Hydrochloride 50SP', 'https://5.imimg.com/data5/ANDROID/Default/2022/8/KJ/CZ/LR/104631070/product-jpeg-500x500.jpg'),
(41, 11, 5, 'Dimethoate 30EC', 'https://www.katyayaniorganics.com/wp-content/uploads/2022/06/Siddhi-400-x-400-px-31.webp'),
(42, 11, 5, 'Fipronil 5SC', 'https://cdn.shopify.com/s/files/1/0722/2059/files/Untitleddesign_7__AkanshaSingh1_1.png'),
(43, 11, 5, 'Imidacloprid 17.8SL', 'https://static.agrostar.in/static/AGS-CP-1235_1.jpg'),
(44, 11, 5, 'Acetamiprid 20SP', 'https://www.albaugh.com/images/indialibraries/productimages/ocilia-packshot-new.png'),
(45, 12, 6, 'Spinetoram 11.7SC', 'https://cultree.in/cdn/shop/files/Summit.jpg'),
(46, 12, 6, 'Chlorantraniliprole 18.5SC', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgD9xV0aMCycCD9NmlsSLmd2J2dWeMcqxO5Q&s'),
(47, 12, 6, 'Emamectin Benzoate 5SG', 'https://static.agrostar.in/static/AGS-CP-731_1.jpg'),
(48, 12, 6, 'Flubendiamide 480SC', 'https://cdn.shopify.com/s/files/1/0722/2059/products/Artboard1copy3-3.webp'),
(49, 13, 6, 'Cartap Hydrochloride 4G', 'https://www.dhanuka.com/storage/products/August2021/YlOwACNYwmT38csvQirS.png'),
(50, 13, 6, 'Chlorantraniliprole 0.4G', 'https://static.agrostar.in/static/AGS-CP-1447_N_l.jpg'),
(51, 13, 6, 'Fipronil 0.3G', 'https://www.napanta.com/app-img/product/ipl_frem_gr.png'),
(52, 13, 6, 'Carbofuran 3G', 'https://5.imimg.com/data5/SELLER/Default/2022/11/LR/YM/IY/79851997/21.jpg'),
(53, 14, 6, 'Tefluthrin 0.5G', 'https://www.agrohouse.gr/docs/Images/Products/b6391258-e68a-4f07-ba78-ffb63a157120.webp'),
(54, 14, 6, 'Chlorpyrifos 15G', 'https://3.imimg.com/data3/DP/IN/GLADMIN-101950/chlorpyrifos-250x250.jpg'),
(55, 14, 6, 'Bifenthrin 10EC', 'https://agribegri.com/productimage/2663029101718875844.webp'),
(56, 14, 6, 'Force 3G', 'https://tlhort.com/cdn/shop/products/Force-3G.jpg'),
(57, 15, 6, 'Thiamethoxam 25WG', 'https://www.katyayaniorganics.com/wp-content/uploads/2022/06/thioxam-768x902-1.png'),
(58, 15, 6, 'Flonicamid 50WG', 'https://cdn.shopify.com/s/files/1/0722/2059/products/ULALA.jpg'),
(59, 15, 6, 'Spirotetramat 150OD', 'https://cultree.in/cdn/shop/files/Movento_1.jpg'),
(60, 15, 6, 'Pymetrozine 50WG', 'https://inputs.kalgudi.com/data/p_images/1568019818173.jpeg'),
(61, 16, 7, 'Thimet 10G', 'https://5.imimg.com/data5/SELLER/Default/2024/4/409652428/QS/SC/DC/1928481/insecticides-10-g-thimet-500x500.png'),
(62, 16, 7, 'Carbofuran 3G', 'https://5.imimg.com/data5/SELLER/Default/2022/11/LR/YM/IY/79851997/21.jpg'),
(63, 17, 7, 'Coragen', 'https://www.kisanestore.com/image/cache/data/FMC%20India/Coragen_FMC-removebg-preview-500x554.png'),
(64, 17, 7, 'Larvin', 'https://5.imimg.com/data5/MD/HI/HJ/GLADMIN-3061/larvin-thiodicarb-75-wp-insecticide.jpg'),
(65, 18, 7, 'Dursban', 'https://cdn.shopify.com/s/files/1/0722/2059/files/1_89e206f6-7c96-4316-a83f-4e4ee26767a6.png'),
(66, 19, 7, 'Decis', 'https://cdn.shopify.com/s/files/1/0722/2059/products/Decis.jpg'),
(67, 20, 8, 'Regent', 'https://fertilizers.com.sg/wp-content/uploads/REGENT-50SC_0151.png'),
(68, 21, 8, 'Confidor', 'https://cdn.shopify.com/s/files/1/0722/2059/products/MicrosoftTeams-image_1.jpg'),
(69, 22, 8, 'Force', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSf3rTSUK3yEPvIo7L-pUcCSdvuwnwAnMYzSQ&s'),
(70, 23, 8, 'Karate', 'https://krushikendra.com/image/cache/catalog/Sygenta/KARATE-500x500.png');

-- --------------------------------------------------------

--
-- Table structure for table `Pests`
--

CREATE TABLE `Pests` (
  `PestID` int(11) NOT NULL,
  `CropID` int(11) DEFAULT NULL,
  `PestName` varchar(100) DEFAULT NULL,
  `ControlMeasures` text DEFAULT NULL,
  `ImageUrl` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Pests`
--

INSERT INTO `Pests` (`PestID`, `CropID`, `PestName`, `ControlMeasures`, `ImageUrl`) VALUES
(1, 1, 'Aphids', 'Use neem oil spray and insecticidal soap.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQj5wE1kPJULAXlLcw5wUpO6r0YKpv4INcltg&s'),
(2, 2, 'Colorado Potato Beetle', 'Use crop rotation and introduce natural predators.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSH3RSQTHrr-YQtrarFgHfcvNEC9zb4yQtLg&s'),
(3, 3, 'Corn Earworm', 'Use Bt crops or insecticides when necessary.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpAHC0q8d49h2OKU8fFyyys3k-WjZeYXDGYw&s'),
(4, 4, 'Brown Planthopper', 'Use resistant varieties, maintain proper spacing, and apply appropriate insecticides.', 'http://www.knowledgebank.irri.org/images/stories/planthopper-brown.jpg'),
(5, 4, 'Yellow Stem Borer', 'Remove egg masses, use pheromone traps, and apply systemic insecticides.', 'http://www.knowledgebank.irri.org/images/stories/stem-borer-larvae.jpg'),
(6, 4, 'Rice Leaf Folder', 'Maintain proper water management and use balanced fertilization. Apply insecticides when necessary.', 'http://www.knowledgebank.irri.org/images/stories/factsheet-leaffolder-1.jpg'),
(7, 4, 'Gall Midge', 'Plant resistant varieties and maintain field hygiene. Use systemic insecticides.', 'http://www.knowledgebank.irri.org/images/stories/factsheet-gall-midge.jpg'),
(8, 5, 'Tobacco Caterpillar', 'Use pheromone traps, encourage natural enemies, and apply neem-based insecticides.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNcDZv-v8JVl7oaujbnjIjavNR9RZAKfeYTg&s'),
(9, 5, 'White Grub', 'Practice summer plowing, use light traps, and apply soil insecticides.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbd6v0niemZl1pcSx1-gl97rNG3BYVVt8AGg&s'),
(10, 5, 'Leaf Miner', 'Monitor early season infestations, use yellow sticky traps, and apply systemic insecticides.', 'https://www.gardendesign.com/pictures/images/600x420Exact_0x100/dream-team-s-portland-garden_6/leaf-miner-larvae-shutterstock-com_17631.jpg'),
(11, 5, 'Thrips', 'Use blue sticky traps, maintain field sanitation, and apply appropriate insecticides.', 'https://www.koppert.co.uk/content/_processed_/5/1/csm_onion_thrips_thrips_tabaci_damage_female_2_koppert_9304e813e1.jpg'),
(12, 6, 'Fall Armyworm', 'Use early warning systems, apply biological control agents, and use selective insecticides.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT19a0WsRuLm64uH1nf-K3EVQrFyKRe28Sb3icHuwYlo8EaGym0zJSa3kJO5gTCAfEVHfk&usqp=CAU'),
(13, 6, 'Stem Borer', 'Practice crop rotation, remove plant debris, and use systemic insecticides.', 'https://www.greenlife.co.ke/wp-content/uploads/2022/04/stalk_borer.jpg'),
(14, 6, 'Rootworm', 'Rotate crops, use soil insecticides, and plant resistant varieties.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTCPFXAZfMR86yHF_VqUUaYLp1_ENpnd9dZadha47YcV4aBUt2Ajx_NTaMRU9O4JZr4EGA&usqp=CAU'),
(15, 6, 'Corn Leaf Aphid', 'Encourage natural enemies, use insecticidal soaps, and apply systemic insecticides when needed.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvoEm8rspmW6YHh6QnG90i8nedTRoIQfhwBg&s'),
(16, 7, 'Shoot Fly', 'Use early planting, remove alternate hosts, and apply seed treatment.', 'https://compress-pop-images.s3.ap-south-1.amazonaws.com/static/1_215796021831579602191.webp'),
(17, 7, 'Stem Borer', 'Remove dead hearts, use pheromone traps, and apply appropriate insecticides.', 'https://www.greenlife.co.ke/wp-content/uploads/2022/04/stalk_borer.jpg'),
(18, 7, 'Armyworm', 'Monitor fields regularly, encourage natural enemies, and use selective insecticides.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT19a0WsRuLm64uH1nf-K3EVQrFyKRe28Sb3icHuwYlo8EaGym0zJSa3kJO5gTCAfEVHfk&usqp=CAU'),
(19, 7, 'Midge', 'Plant uniform crops, use resistant varieties, and apply insecticides at flowering stage.', 'http://www.knowledgebank.irri.org/images/stories/factsheet-gall-midge.jpg'),
(20, 8, 'White Grub', 'Practice deep summer plowing, use light traps, and apply soil insecticides.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbd6v0niemZl1pcSx1-gl97rNG3BYVVt8AGg&s'),
(21, 8, 'Shoot Fly', 'Use higher seed rate, remove affected seedlings, and apply seed treatments.', 'https://compress-pop-images.s3.ap-south-1.amazonaws.com/static/1_215796021831579602191.webp'),
(22, 8, 'Wire Worm', 'Practice crop rotation, maintain field sanitation, and use soil insecticides.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdcvNShJldu7bCrqOX5bNAOdR90YflHBGHuA&s'),
(23, 8, 'Army Worm', 'Monitor fields regularly, use pheromone traps, and apply need-based insecticides.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT19a0WsRuLm64uH1nf-K3EVQrFyKRe28Sb3icHuwYlo8EaGym0zJSa3kJO5gTCAfEVHfk&usqp=CAU');

-- --------------------------------------------------------

--
-- Table structure for table `WeedProducts`
--

CREATE TABLE `WeedProducts` (
  `ProductID` int(11) NOT NULL,
  `WeedID` int(11) DEFAULT NULL,
  `CropID` int(11) DEFAULT NULL,
  `ProductName` varchar(100) DEFAULT NULL,
  `ProductURL` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `WeedProducts`
--

INSERT INTO `WeedProducts` (`ProductID`, `WeedID`, `CropID`, `ProductName`, `ProductURL`) VALUES
(1, 1, 1, 'Sedgehammer Plus', 'https://images-cdn.ubuy.co.in/635420e3f243a81efb578f04-sedgehammer-plus-turf-herbicide-13-5.jpg'),
(2, 2, 1, 'Dual Magnum', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnofMyDzALSGeyQnQ5Eystn5W1VpYejD0ktg&s'),
(3, 3, 1, 'Poast', 'https://www.seedworldusa.com/cdn/shop/products/Poast_2.5_Gallons_2048x.jpg'),
(4, 4, 2, 'Matrix', 'https://www.militellofarmsupply.com/wp-content/uploads/2024/02/Matrix_SG.webp'),
(5, 5, 2, 'Eptam', 'https://steveregan.com/cdn/shop/products/pixlr-bg-result_4_1_1200x1200.png'),
(6, 6, 2, 'Sencor', 'https://agribegri.com/productimage/13951731651715779082.webp'),
(7, 7, 3, 'Accent Q', 'https://chemicalwarehouse.com/cdn/shop/files/Pastora_5Ounces_Image_ChemicalWarehouse_98fb2ef8-7667-4030-b6e9-20b658f7c446_1024x1024.jpg'),
(8, 8, 3, 'Callisto', 'https://www.nexles.com/media/catalog/product/cache/14/thumbnail/500x/8083c875e83be300356bb052a4e4af68/c/a/callisto_1.jpg'),
(9, 9, 3, 'Roundup PowerMax', 'https://images-cdn.ubuy.co.in/66a343ab5d11e0314345fe95-round-up-power-max-48-7-2-5-gallon.jpg'),
(10, 10, 4, 'Regiment', 'https://5.imimg.com/data5/SELLER/Default/2024/5/421236961/UE/VY/MZ/220687054/regiment-super.jpg'),
(11, 11, 4, 'Clincher', 'https://honeybee-static-production.s3.amazonaws.com/product-images/52e5afb5-b4df-4db2-a752-f6601f1fc676.webp'),
(12, 12, 4, 'Londax', 'https://5.imimg.com/data5/UR/MD/SP/GLADMIN-3061/dupont-londax-power-herbicide-4-kg.jpg'),
(13, 13, 5, 'Pursuit', 'https://agribegri.com/productimage/9c2836daa9d17c938bc39bc25b29afff-01-28-22-16-23-40.webp'),
(14, 14, 5, 'Basagran', 'https://cdn.shopify.com/s/files/1/0722/2059/products/Artboard1copy21-3_b09cdb31-5c15-4917-9ab3-e32c4089f9e3.webp'),
(15, 15, 5, 'Classic', 'https://www.globalcropcare.com/wp-content/uploads/2023/03/Classic.png'),
(16, 16, 6, 'Atrazine', 'https://cdn.nufarm.com/wp-content/uploads/sites/17/2018/06/18123854/flowable-atrazine-500_20l.jpg'),
(17, 17, 6, 'Halex GT', 'https://m.media-amazon.com/images/I/41hTHmqkfJL.jpg'),
(18, 18, 6, 'Laudis', 'https://krishimart.in/public/uploads/all/w1L34CbDPv6aIw9X0vls0tyAhK7qKSnp7n8uBFcH.jpg'),
(19, 19, 7, 'Huskie', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8y_YHVJE6KfhxZH22m8Z1e1_ZJz954hB7tQ&s'),
(20, 20, 7, 'Peak', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUoiBQOLnIJawyprGP8XUWMcGp9VdtG9c0Hw&s'),
(21, 21, 7, 'Paramount', 'https://5.imimg.com/data5/IOS/Default/2021/9/SC/MC/UP/19188660/product-jpeg.png'),
(22, 22, 8, 'Prowl H2O', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQR04gvG7LNYxgffJPBsFzxG_keqHRIBG3dsA&s'),
(23, 23, 8, 'Gramoxone', 'https://m.media-amazon.com/images/I/61I9tYCQ7vS.jpg'),
(24, 24, 8, 'Permit', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShvAm21sO6JejEuloGrmuAR6nhX9nwvz4VtQ&s');

-- --------------------------------------------------------

--
-- Table structure for table `Weeds`
--

CREATE TABLE `Weeds` (
  `WeedID` int(11) NOT NULL,
  `CropID` int(11) DEFAULT NULL,
  `WeedName` varchar(100) DEFAULT NULL,
  `ControlMeasures` text DEFAULT NULL,
  `ImageUrl` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Weeds`
--

INSERT INTO `Weeds` (`WeedID`, `CropID`, `WeedName`, `ControlMeasures`, `ImageUrl`) VALUES
(5, 2, 'Field Bindweed', 'Use post-emergence herbicides and crop rotation', 'https://www.epicgardening.com/wp-content/uploads/2024/07/Bindweed.jpg'),
(4, 2, 'Quackgrass', 'Deep tillage and systemic herbicide application', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSmZuMCMwGXN3k2vu7jDtDwPToC33zyDKks3Q&s'),
(2, 1, 'Lambsquarters', 'Use mulching and regular hand weeding', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvd6saE__O5xCp3I9Ub8q6KK8QnX7WjEgwKg&s'),
(3, 1, 'Purslane', 'Practice shallow cultivation and use organic mulch', 'https://media.post.rvohealth.io/wp-content/uploads/2020/08/purslane-thumb.jpg'),
(1, 1, 'Nutsedge', 'Apply selective herbicides and maintain proper irrigation', 'https://hgic.clemson.edu/wp-content/uploads/2019/11/yellow-nutsedge-cyperus-esculentus-has-a-greeni-scaled.jpeg'),
(6, 2, 'Canada Thistle', 'Implement integrated weed management and regular mowing', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-ml4Y-_MT1QZcHbFRCIOO2FVCTFViXca7Aw&s'),
(7, 3, 'Foxtail', 'Apply pre-emergence herbicides and practice crop rotation', 'https://media.tegna-media.com/assets/CCT/images/acd19df8-d45b-4b46-8f77-f5d7a8557be6/20240510T204233/acd19df8-d45b-4b46-8f77-f5d7a8557be6_750x422.jpg'),
(8, 3, 'Velvetleaf', 'Use post-emergence herbicides and mechanical cultivation', 'https://www.bleedingheartland.com/static/media/2020/09/velvetleafhorizontal1-700x478.jpg'),
(9, 3, 'Johnson Grass', 'Implement tillage practices and use selective herbicides', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgjChl_xJ8dpaEWRFu3PUuPu2LdeLQaEcd6A&s'),
(10, 4, 'Barnyard Grass', 'Water management and selective herbicide application', 'http://www.knowledgebank.irri.org/images/stories/weeds-ecolona.jpg'),
(11, 4, 'Red Rice', 'Certified seed use and proper land leveling', 'https://weeds.org.au/wp-content/uploads/2024/07/Oryza-rufipogon.jpg'),
(12, 4, 'Water Hyacinth', 'Mechanical removal and biological control methods', 'https://cdn.britannica.com/22/119122-050-E117CF3E/water-hyacinth.jpg'),
(13, 5, 'Yellow Nutsedge', 'Pre-plant incorporated herbicides and proper spacing', 'https://images.squarespace-cdn.com/content/v1/50a39d4ce4b0f822f291399c/1598454875448-DY6Y8YVG8MCYM653DB6E/Yellow+Nut+Sedge'),
(14, 5, 'Crowfoot Grass', 'Pre-emergence herbicides and timely inter-cultivation', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSH3sWlLWr68hA2oiDUIXM_o-JaYLCiLFWV0w&s'),
(15, 5, 'Morning Glory', 'Post-emergence herbicides and manual removal', 'https://www.ugaoo.com/cdn/shop/articles/0aafab6b4e.jpg?v=1704795270'),
(16, 6, 'Fall Panicum', 'Early season weed control and herbicide application', 'https://www.sare.org/wp-content/uploads/fall_panicum_C-900x1200.jpeg'),
(17, 6, 'Cocklebur', 'Post-emergence herbicides and mechanical control', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpmi0UFyRQW3LiV27_o_B-rszbQrvrFk-n6A&s'),
(18, 6, 'Ragweed', 'Integrated weed management and proper timing of control', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Ambrosia_psilostachya_kz1.jpg/800px-Ambrosia_psilostachya_kz1.jpg'),
(19, 7, 'Striga', 'Resistant varieties and integrated striga management', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTaUhQGu2eSxC4sLgXN4kzQLKDZCKACNA4GoA&s'),
(20, 7, 'Pigweed', 'Pre-emergence herbicides and cultural control methods', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyPYpfol_A8uPNK3drGeh8isKbIMssNM3zLA&s'),
(21, 7, 'Field Sandbur', 'Tillage practices and selective herbicide application', 'https://www.weedalert.com/wp-content/uploads/2020/09/Sandbur2.jpg'),
(22, 8, 'Wild Sorghum', 'Early weed control and proper spacing', 'https://www.picturethisai.com/image-handle/website_cmsname/image/1080/153858025076031528.jpeg'),
(23, 8, 'Goosegrass', 'Pre-emergence herbicides and inter-row cultivation', 'https://cals.cornell.edu/sites/default/files/styles/image_callout_standard/public/2022-06/goosegrass-b_edit_small.jpg'),
(24, 8, 'Purple Nutsedge', 'Integrated weed management and proper land preparation', 'https://eorganic.org/sites/eorganic.info/files/u257/Node5134-rhizomes.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AudioResponses`
--
ALTER TABLE `AudioResponses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CropsData`
--
ALTER TABLE `CropsData`
  ADD PRIMARY KEY (`CropID`);

--
-- Indexes for table `DiseaseProducts`
--
ALTER TABLE `DiseaseProducts`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `DiseaseID` (`DiseaseID`),
  ADD KEY `CropID` (`CropID`);

--
-- Indexes for table `Diseases`
--
ALTER TABLE `Diseases`
  ADD PRIMARY KEY (`DiseaseID`),
  ADD KEY `CropID` (`CropID`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_pin` (`unique_pin`);

--
-- Indexes for table `PestProducts`
--
ALTER TABLE `PestProducts`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `PestID` (`PestID`),
  ADD KEY `CropID` (`CropID`);

--
-- Indexes for table `Pests`
--
ALTER TABLE `Pests`
  ADD PRIMARY KEY (`PestID`),
  ADD KEY `CropID` (`CropID`);

--
-- Indexes for table `WeedProducts`
--
ALTER TABLE `WeedProducts`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `WeedID` (`WeedID`),
  ADD KEY `CropID` (`CropID`);

--
-- Indexes for table `Weeds`
--
ALTER TABLE `Weeds`
  ADD PRIMARY KEY (`WeedID`),
  ADD KEY `CropID` (`CropID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AudioResponses`
--
ALTER TABLE `AudioResponses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CropsData`
--
ALTER TABLE `CropsData`
  MODIFY `CropID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `DiseaseProducts`
--
ALTER TABLE `DiseaseProducts`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `Diseases`
--
ALTER TABLE `Diseases`
  MODIFY `DiseaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `PestProducts`
--
ALTER TABLE `PestProducts`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `Pests`
--
ALTER TABLE `Pests`
  MODIFY `PestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `WeedProducts`
--
ALTER TABLE `WeedProducts`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `Weeds`
--
ALTER TABLE `Weeds`
  MODIFY `WeedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
