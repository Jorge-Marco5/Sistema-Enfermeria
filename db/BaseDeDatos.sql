-- Active: 1743566648365@@127.0.0.1@5432@sistemaenfermeria
CREATE DATABASE sistemaEnfermeria;

use sistemaenfermeria;

CREATE TABLE Personas (
    id_persona SERIAL PRIMARY KEY,
    matricula VARCHAR(20) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(50) NOT NULL,
    apellido_materno VARCHAR(50),
    fecha_nacimiento DATE NOT NULL,
    genero VARCHAR(10) CHECK (genero IN ('Masculino', 'Femenino', 'Otro')),
    tipo_sangre VARCHAR(5),
    rol VARCHAR(10) CHECK (rol IN ('Alumno', 'Docente', 'Administrativo')),
    contacto_emergencia_nombre VARCHAR(100) NOT NULL,
    contacto_emergencia_telefono VARCHAR(20) NOT NULL,
    contacto_emergencia_relacion VARCHAR(50)
);

CREATE TABLE HistorialMedico (
    id_historial INT PRIMARY KEY SERIAL,
    enfermedades TEXT, -- Lista separada por comas si es necesario
    alergias TEXT,
    cirugias TEXT,
    medicacion TEXT,
    discapacidad TEXT,
    matricula VARCHAR(10)
);

CREATE TABLE SaludMental (
    id_mental SERIAL PRIMARY KEY,
    diagnostico TEXT,
    terapia TEXT,
    contacto_terapeuta VARCHAR(100),
    telefono_terapeuta VARCHAR(20),
    matricula VARCHAR(10)
);

CREATE TABLE Vacunacion (
    id_vacuna SERIAL PRIMARY KEY,
    direccion_img VARCHAR(100) NOT NULL,
    matricula VARCHAR(10)
);

CREATE TABLE SeguroMedico (
    id_seguro SERIAL PRIMARY KEY,
    aseguradora VARCHAR(100),
    numero_poliza VARCHAR(50),
    hospital_referencia VARCHAR(100),
    medico_cabecera VARCHAR(100),
    matricula VARCHAR(10)
);

CREATE TABLE AutorizacionesMedicas (
    id_autorizacion SERIAL PRIMARY KEY,
    primeros_auxilios BOOLEAN DEFAULT FALSE,
    administracion_medicamentos BOOLEAN DEFAULT FALSE,
    medicamentos_autorizados TEXT,
    restricciones_medicas TEXT,
    matricula VARCHAR(10)
);

CREATE TABLE administradores (
    id_Admin SERIAL PRIMARY KEY,
    nombreAdmin VARCHAR(100) NOT NULL,
    matricula VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Se almacenará encriptada con `password_hash`
    fecha TIMESTAMP
);

ALTER TABLE Personas
ADD COLUMN matricula VARCHAR(20) UNIQUE NOT NULL;

CREATE TABLE Log (
    id_log SERIAL PRIMARY KEY,
    tipo_error VARCHAR(100) NOT NULL,
    mensaje TEXT NOT NULL,
    ubicacion_error TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE consulta_Medica (
    id_consulta SERIAL PRIMARY KEY,
    matricula VARCHAR(20) NOT NULL,
    fecha DATE NOT NULL,
    motivo_consulta TEXT NOT NULL,
);



--LLENADO DE LA LISTA DE ENFERMEDADES, ALERGIAS, CIRUGIAS Y MEDICAMENTOS    

CREATE TABLE Lista_Enfermedades (
    id_Enfermedad SERIAL PRIMARY KEY,
    nombre_Enfermedad VARCHAR(100) NOT NULL,
);

INSERT INTO Lista_Enfermedades (nombre_Enfermedad) VALUES
('	Acné'),
('	Alergias (alimentarias, estacionales, cutáneas)	'),
('	Alzhéimer'),
('	Anemia	'),
('	Ansiedad '),
('	Apnea del sueño'),
('	Arritmia cardíaca'),
('	Artritis '),
('	Asma'),
('	Aterosclerosis	'),
('	Bronquitis '),
('	Bulimia nerviosa	'),
('	Cálculos biliares (Colelitiasis)	'),
('	Cálculos renales	'),
('	Cáncer de pulmón, mama, próstata, etc.'),
('	Cáncer de piel'),
('	Cáncer de colon	'),
('	Cáncer de páncreas	'),
('	Cáncer de testículo	'),
('	Cáncer de tiroides	'),
('	Cáncer gástrico	'),
('	Cáncer hematológico (leucemia, linfoma)	'),
('	Cáncer hepático	'),
('	Cáncer oral	'),
('	Cáncer orofaríngeo	'),
('	Cáncer de esófago	'),
('	Cáncer de laringe	'),
('	Cáncer de faringe	'),
('	Cáncer de vejiga	'),
('	Cáncer de endometrio	'),
('	Cáncer de cuello uterino	'),
('	Cáncer de ovario	'),
('	Cáncer de próstata	'),
('	Cáncer de riñón	'),
('	Cáncer de piel no melanoma	'),
('	Cáncer de mama'),
('	Cáncer de colon y recto	'),
('	Cáncer de pulmón no microcítico	'),
('	Cáncer de pulmón microcítico	'),
('	Cáncer de tiroides papilar	'),
('	Cáncer de tiroides folicular	'),
('	Cáncer de tiroides medular	'),
('	Cáncer de tiroides anaplásico'),
('	Cáncer gástrico difuso'),
('	Cáncer gástrico intestinal'),
('	Cáncer oral'),
('	Cáncer uterino'),
('	Cáncer vesical'),
('	Candidiasis vaginal	'),
('	Candidiasis (infección por hongos)'),
('	Cataratas'),
('	Cefalea'),
('	Celiaquía (Enfermedad celíaca)	'),
('	Chikungunya'),
('	Cirrosis hepática'),
('	Clamidia (infección de transmisión sexual)	'),
('	Colesterol alto (Hipercolesterolemia)	'),
('	Conjuntivitis	'),
('	COVID-19	'),
('	Culebrilla (Herpes zóster)	'),
('	Dengue	'),
('	Depresión	'),
('	Dermatitis (atópica, de contacto)	'),
('	Diabetes mellitus (tipo 1 y tipo 2)	'),
('	Diarrea (aguda, crónica)	'),
('	Dislipidemia	'),
('	Eczema	'),
('	Enfermedad de Crohn'),
('	Enfermedad de Lyme'),
('	Enfermedad de Parkinson	'),
('	Enfermedad por reflujo gastroesofágico (ERGE)'),
('	Epilepsia	'),
('	Esclerosis múltiple	'),
('	Esquizofrenia	'),
('	Esofagitis	'),
('	Estreñimiento	'),
('	Fibromialgia	'),
('	Fiebre tifoidea	'),
('	Faringitis'),
('	Fracturas óseas	'),
('	Gastritis'),
('	Gingivitis'),
('	Glaucoma'),
('	Gonorrea'),
('	Gota'),
('	Halitosis (mal aliento)'),
('	Hemorroides	'),
('	Hepatitis (A, B, C, etc.)'),
('	Herpes (simple, genital)	'),
('	Hipertensión arterial	'),
('	Hipotiroidismo / Hipertiroidismo'),
('	Hiperuricemia	'),
('	Hipoglucemia	'),
('	Hipoglucemia reactiva	'),
('	Hipovolemia	'),
('	Hirsutismo	'),
('	Impetigo'),
('	Incontinencia urinaria	'),
('	Infección del tracto urinario (ITU)	'),
('	Influenza (gripe)'),
('	Insomnio	'),
('	Insuficiencia cardíaca	'),
('	Insuficiencia renal	'),
('	Leucemia	'),
('	Linfoma'),
('	Malaria (Paludismo)	'),
('	Melanoma (cáncer de piel)'),
('	Meningitis	'),
('	Miastenia gravis'),
('	Migraña'),
('	Mononucleosis'),
('	Neumonía'),
('	Neuropatía diabética'),
('	Obesidad'),
('	Osteoartritis'),
('	Osteoporosis'),
('	Pancreatitis'),
('	Paperas (Parotiditis)	'),
('	Parkinson '),
('	Pie diabético	'),
('	Poliomielitis	'),
('	Psoriasis	'),
('	Resfriado común	'),
('	Rinitis alérgica	'),
('	Rosácea'),
('	Rubéola'),
('	Sarampión'),
('	Sarcoma'),
('	Sífilis'),
('	Síndrome del intestino irritable (SII)'),
('	Sinusitis'),
('	Tendinitis'),
('	Tétanos	'),
('	Tinnitus (acúfenos)'),
('	Tos ferina (Pertussis)'),
('	Tuberculosis'),
('	Úlcera gástrica / Úlcera péptica	'),
('	Urticaria'),
('	Varicela'),
('	Varices'),
('	Vértigo'),
('	VIH/SIDA'),
('	Zika');


CREATE TABLE Lista_Alergias (
    id_Alergia SERIAL PRIMARY KEY,
    nombre_Alergia VARCHAR(100) NOT NULL
);

INSERT INTO Lista_Alergias (nombre_Alergia) VALUES
('Alergia a alimentos'),
('Alergia a amoxacilina'),
('Alergia a penicilina'),
('Alergia a aspirina'),
('Alergia a ibuprofeno'),
('Alergia a salbutamol'),
('Alergia a sulfonamidas'),
('Alergia a antibióticos'),
('Alergia a medicamentos antiinflamatorios no esteroides (AINEs)'),
('Alergia a anestésicos locales'),
('Alergia a látex'),
('Alergia a antibióticos (tetraciclinas, macrólidos)'),
('Alergia a polen'),
('Alergia a polvo'),
('Alergia a moho'),
('Alergia a animales (perros, gatos)'),
('Alergia a ácaros'),
('Alergia a hongos'),
('Alergia a picaduras de insectos'),
('Alergia al látex'),
('Alergia al sol'),
('Alergia al frío'),
('Alergia al calor'),
('Alergia al agua'),
('Alergia a productos químicos'),
('Alergia a cosméticos'),
('Alergia a metales (niquel, cromo)'),
('Alergia a fragancias'),
('Alergia a conservantes'),
('Alergia a colorantes'),
('Alergia a aditivos alimentarios'),
('Alergia a gluten'),
('Alergia a lactosa'),
('Alergia a frutos secos'),
('Alergia a mariscos'),
('Alergia a pescado'),
('Alergia a huevos'),
('Alergia a soja'),
('Alergia a trigo'),
('Alergia a cacahuates'),
('Alergia a lácteos'),
('Alergia a frutas (fresas, kiwi)'),
('Alergia a verduras (apio, zanahoria)'),
('Alergia a hierbas (albahaca, orégano)'),
('Alergia a especias (canela, pimienta)'),
('Alergia a hongos'),
('Alergia a látex');

CREATE TABLE Lista_Cirugias (
    id_Cirugia SERIAL PRIMARY KEY,
    nombre_Cirugia VARCHAR(100) NOT NULL
);

INSERT INTO Lista_Cirugias (nombre_Cirugia) VALUES
('Apendicectomía'),
('Amputación'),
('Artroscopia'),
('Adenoidectomía'),
('Bypass gástrico'),
('Biopsia quirúrgica'),
('Blefaroplastia'),
('Cesárea'),
('Cirugía de cataratas'),
('Colecistectomía'),
('Cirugía de columna'),
('Circuncisión'),
('Coronariografía'),
('Dilatación y curetaje'),
('Desbridamiento quirúrgico'),
('Endarterectomía carotídea'),
('Esofagectomía'),
('Fistulectomía'),
('Fijación de fracturas'),
('Herniorrafia'),
('Histerectomía'),
('Hemicolectomía'),
('Lobectomía pulmonar'),
('Laparoscopia'),
('Lifting facial'),
('Mastectomía'),
('Miringotomía'),
('Nefrectomía'),
('Neurocirugía'),
('Ooforectomía'),
('Ostomía'),
('Prótesis de cadera/rodilla'),
('Prostatectomía'),
('Piloroplastia'),
('Reemplazo valvular cardíaco'),
('Rinoplastia'),
('Tiroidectomía'),
('Transplantes'),
('Tubectomía'),
('Vasectomía'),
('Vulvectomía'),
('Whipple'),
('Zonas de resección'),
('Cirugía bariátrica'),
('Cirugía reconstructiva'),
('Cirugía plástica estética'),
('Cirugía ortopédica'),
('Cirugía vascular'),
('Cirugía torácica'),
('Cirugía pediátrica'),
('Cirugía oncológica'),
('Cirugía urológica'),
('Cirugía ginecológica'),
('Cirugía otorrinolaringológica'),
('Cirugía oftalmológica'),
('Cirugía maxilofacial'),
('Cirugía de trasplante de órganos'),
('Cirugía laparoscópica'),
('Cirugía robótica'),
('Cirugía mínimamente invasiva'),
('Cirugía de emergencia'),
('Cirugía electiva'),
('Cirugía ambulatoria'),
('Cirugía mayor'),
('Cirugía menor'),
('Cirugía reconstructiva');

CREATE TABLE Lista_Medicamentos (
    id_Medicamento SERIAL PRIMARY KEY,
    nombre_Medicamento VARCHAR(100) NOT NULL
);

INSERT INTO Lista_Medicamentos (nombre_Medicamento) VALUES
('	Paracetamol	'),
('	Ibuprofeno	'),
('	Naproxeno	'),
('	Diclofenaco	'),
('	Celecoxib	'),
('	Aspirina	'),
('	Ketorolaco	'),
('	Tramadol	'),
('	Morfina	'),
('	Oxicodona	'),
('	Amoxicilina	'),
('	Amoxicilina + Ácido clavulánico	'),
('	Azitromicina	'),
('	Ciprofloxacino	'),
('	Doxiciclina	'),
('	Clindamicina	'),
('	Levofloxacino	'),
('	Metronidazol	'),
('	Penicilina G	'),
('	Vancomicina	'),
('	Loratadina	'),
('	Cetirizina	'),
('	Fexofenadina	'),
('	Difenhidramina	'),
('	Desloratadina	'),
('	Sertralina	'),
('	Fluoxetina	'),
('	Escitalopram	'),
('	Venlafaxina	'),
('	Duloxetina	'),
('	Alprazolam	'),
('	Clonazepam	'),
('	Diazepam	'),
('	Losartán	'),
('	Enalapril	'),
('	Amlodipino	'),
('	Metoprolol	'),
('	Hidroclorotiazida	'),
('	Warfarina	'),
('	Rivaroxabán	'),
('	Aspirina	'),
('	Omeprazol	'),
('	Ranitidina	'),
('	Loperamida	'),
('	Metoclopramida	'),
('	Lactulosa	'),
('	Metformina	'),
('	Insulina	'),
('	Glimepirida	'),
('	Empagliflozina	'),
('	Prednisona	'),
('	Dexametasona	'),
('	Hidrocortisona	'),
('	Aciclovir	'),
('	Oseltamivir	'),
('	Valaciclovir	'),
('	Atorvastatina	'),
('	Levotiroxina	'),
('	Montelukast	'),
('	Finasterida	');


CREATE TABLE Lista_Discapacidades (
    id_Discapacidad SERIAL PRIMARY KEY,
    nombre_Discapacidad VARCHAR(100) NOT NULL
);

INSERT INTO Lista_Discapacidades (nombre_Discapacidad) VALUES
('	Discapacidad visual	'),
('	Discapacidad auditiva	'),
('	Discapacidad motora	'),
('	Discapacidad intelectual	'),
('	Discapacidad del habla	'),
('	Discapacidad psicosocial	'),
('	Discapacidad múltiple	'),
('	Discapacidad del desarrollo	'),
('	Discapacidad cognitiva	'),
('	Discapacidad de aprendizaje	'),
('	Discapacidad del equilibrio	'),
('	Discapacidad de la coordinación	'),
('	Discapacidad de la movilidad	'),
('	Discapacidad de la percepción sensorial	'),
('	Discapacidad de la comunicación no verbal	'),
('	Discapacidad de la memoria	'),
('	Discapacidad de la atención y concentración'),
('	Discapacidad de la planificación y organización	'),
('	Discapacidad de la resolución de problemas	'),
('	Discapacidad de la toma de decisiones	'),
('	Discapacidad de la regulación emocional	'),
('	Discapacidad de la empatía	'),
('	Discapacidad de la interacción social	'),
('	Discapacidad de la adaptación al cambio	'),
('	Discapacidad de la autoayuda y autocuidado	'),
('	Discapacidad de la movilidad funcional	'),
('	Discapacidad de la vida independiente	'),
('	Discapacidad de la participación social	'),
('	Discapacidad del aprendizaje social y emocional'),
('	Discapacidad del aprendizaje académico	'),
('	Discapacidad del aprendizaje motor	'),
('	Discapacidad del aprendizaje perceptual	'),
('	Discapacidad del aprendizaje verbal	'),
('	Discapacidad del aprendizaje no verbal	'),
('	Discapacidad del aprendizaje visual	'),
('	Discapacidad del aprendizaje auditivo	'),
('	Discapacidad del aprendizaje táctil	'),
('	Discapacidad del aprendizaje olfativo	'),
('	Discapacidad del aprendizaje gustativo	'),
('	Discapacidad del aprendizaje kinestésico	'),
('	Discapacidad del aprendizaje emocional	'),
('	Discapacidad del aprendizaje social');


CREATE TABLE Campañas (
    id SERIAL PRIMARY KEY,
    descripcionCampaña VARCHAR(255) NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFinal DATE NOT NULL,
    fechaAgregada TIMESTAMP
);

CREATE TABLE vacunas (
    id SERIAL PRIMARY KEY,
    nombre_vacuna VARCHAR(100) NOT NULL,
    fecha_aplicacion DATE NOT NULL,
    dosis VARCHAR(50),
    observaciones TEXT
);

SELECT nombre_Discapacidad FROM Lista_Discapacidades ORDER BY nombre_Discapacidad ASC;

SELECT * FROM Lista_Discapacidades;

SELECT * FROM Lista_Cirugias where id_persona = 0;

delete from Lista_Alergias where id_alergia >= 0;

--Consulta para el llenado del formato de excel
SELECT P.nombre, 
P.matricula,
P.apellido_paterno, 
P.apellido_materno, 
P.fecha_nacimiento, 
P.genero, 
P.tipo_sangre, 
P.contacto_emergencia_nombre,
P.contacto_emergencia_telefono,
P.contacto_emergencia_relacion,
H.alergias,
H.enfermedades,
H.cirugias,
H.medicacion,
H.discapacidad,
S.aseguradora,
S.numero_poliza,
S.hospital_referencia
FROM personas P
INNER JOIN historialmedico H
ON P.matricula = H.matricula
INNER JOIN seguromedico S
ON P.matricula = S.matricula
WHERE P.matricula = '21ISIC050'


SELECT 
    p.nombre, p.apellido_paterno, p.apellido_materno, p.tipo_sangre,
    p.contacto_emergencia_nombre, p.contacto_emergencia_telefono, p.contacto_emergencia_relacion,
    h.enfermedades, h.alergias, h.medicacion,
    s.aseguradora, s.numero_poliza, s.hospital_referencia,
    a.primeros_auxilios, a.administracion_medicamentos, a.medicamentos_autorizados
FROM Personas p
LEFT JOIN HistorialMedico h ON p.id_persona = h.id_persona
LEFT JOIN SeguroMedico s ON p.id_persona = s.id_persona
LEFT JOIN AutorizacionesMedicas a ON p.id_persona = a.id_persona
WHERE p.id_persona = 1;
