# Relational Model Design
## <ins>Schema and Functional Dependencies</ins>
### Galaxy
- **_ID_**: *char[64]*, **Size**: *integer*, **Shape**: *char[64]*, **Type**: *char[64]*
- **Functional Dependencies:**
  - *_ID_ -> Size, Shape, Type*
  - *Type -> Shape*
  - *Shape -> Type*

### BlackHole
- **_ID_**: *char[64]*, **MassType**: *char[64]*, **Radius**: *integer*, **Mass**: *integer*, **GalaxyId**: *char[64]*
- **Functional Dependencies:**
  - *_ID_ -> MassType, Radius, Mass, GalaxyId*
  - *Mass -> MassType*

### PlanetarySystem
- **_ID_**: *char[64]*, **Type**: *char[64]*, **Age**: *integer*, **GalaxyId**: *char[64]*
- **Functional Dependencies:**
  - *_ID_ -> Type, Age, GalaxyId*

### Asteroid
- **_ID_**: *char[64]*, **Composition**: *char[64]*, **Type**: *char[64]*, **GalaxyId**: *char[64]*
- **Functional Dependencies:**
  - *_ID_ -> Composition, Type, GalaxyId*
  - *Composition -> Type*
  - *Type -> Composition*

### Meteor
- **_ID_**: *char[64]*, **PlanetEnteredID**: *char[64]*
- **Functional Dependencies:**
  - *_ID_, PlanetID -> Mass*

### Nebula
- **_ID_**: *char[64]*, **Type**: *char[64]*, **Magnitude**: *integer*, **GalaxyId**: *char[64]*
- **Functional Dependencies:**
  - *_ID_ -> Type, Magnitude, GalaxyID*

### Satellite
- **_ID_**: *char[64]*, **PlanetId**: *char[64]*, **Mass**: *integer*
- **Functional Dependencies:**
  - *_ID_, PlanetID -> Mass*

### Moon
- **_ID_**: *char[64]*, **Radius**: *integer*
- **Functional Dependencies:**
  - *_ID_ -> Radius*

### Planet
- **_ID_**: *char[64]*, **Declination**: *integer*, **Right Ascension**: *integer*, **Mass**: *integer*, **Radius**: *integer*, **Type**: *char[64]*, **planetarySystemId**: *char[64]*
- **Functional Dependencies:**
  - *_ID_ -> Declination, Right Ascension, Mass, Radius, Type, PlanetarySystemID*

### Star
- **_ID_**: *char[64]*, **Declination**: *integer*, **Right Ascension**: *integer*, **Type**: *char[64]*, **Mass**: *integer*, **Radius**: *integer*, **Temperature**: *integer*, **Luminosity**: *integer*, **planetarySystemId**: *char[64]*
- **Functional Dependencies:**
  - *_ID_ -> Declination, RightAscension, Mass, Radius, Type, PlanetarySystemID*
