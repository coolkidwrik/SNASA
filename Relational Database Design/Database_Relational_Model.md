# Relational Model Design
## <ins>Schema and Functional Dependencies</ins>
### Galaxy
- **ID**: *char[64]*
- **Size**: *integer*
- **Shape**: *char[64]*
- **Type**: *char[64]*
- **Functional Dependencies:**
  - *ID -> Size, Shape, Type*
  - *Type -> Shape*
  - *Shape -> Type*

### BlackHole
- **ID**: *char[64]*
- **MassType**: *char[64]*
- **Radius**: *integer*
- **Mass**: *integer*
- **GalaxyId**: *char[64]*
- **Functional Dependencies:**
  - *ID -> MassType, Radius, Mass, GalaxyId*
  - *Mass -> MassType*

### PlanetarySystem
- **ID**: *char[64]*
- **Type**: *char[64]*
- **Age**: *integer*
- **GalaxyId**: *char[64]*
- **Functional Dependencies:**
  - *ID -> Type, Age, GalaxyId*

### Asteroid
- **ID**: *char[64]*
- **Composition**: *char[64]*
- **Type**: *char[64]*
- **GalaxyId**: *char[64]*
- **Functional Dependencies:**
  - *ID -> Composition, Type, GalaxyId*
  - *Composition -> Type*
  - *Type -> Composition*

### Meteor
- **ID**: *char[64]*
- **PlanetEnteredID**: *char[64]*
- **Functional Dependencies:**
  - *ID, PlanetID -> Mass*

### Nebula
- **ID**: *char[64]*
- **Type**: *char[64]*
- **Magnitude**: *integer*
- **GalaxyId**: *char[64]*
- **Functional Dependencies:**
  - *ID -> Type, Magnitude, GalaxyID*

### Satellite
- **ID**: *char[64]*
- **PlanetId**: *char[64]*
- **Mass**: *integer*
- **Functional Dependencies:**
  - *ID, PlanetID -> Mass*

### Moon
- **ID**: *char[64]*
- **Radius**: *integer*
- **Functional Dependencies:**
  - *ID -> Radius*

### Planet
- **ID**: *char[64]*
- **Declination**: *integer*
- **Right Ascension**: *integer*
- **Mass**: *integer*
- **Radius**: *integer*
- **Type**: *char[64]*
- **planetarySystemId**: *char[64]*
- **Functional Dependencies:**
  - *ID -> Declination, Right Ascension, Mass, Radius, Type, PlanetarySystemID*

### Star
- **ID**: *char[64]*
- **Declination**: *integer*
- **Right Ascension**: *integer*
- **Type**: *char[64]*
- **Mass**: *integer*
- **Radius**: *integer*
- **Temperature**: *integer*
- **Luminosity**: *integer*
- **planetarySystemId**: *char[64]*
- **Functional Dependencies:**
  - *ID -> Declination, RightAscension, Mass, Radius, Type, PlanetarySystemID*
