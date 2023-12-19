# Relational Model Design
## <ins>Schema and Functional Dependencies</ins>
Galaxy(<ins>**ID**: *char[64]*</ins>, **Size**: *integer*, **Shape**: *char[64]*, **Type**: *char[64]*)
- **Functional Dependencies:**
  - *ID -> Size, Shape, Type*
  - *Type -> Shape*
  - *Shape -> Type*

BlackHole(<ins>**ID**: *char[64]*</ins>, **MassType**: *char[64]*, **Radius**: *integer*, **Mass**: *integer*, **GalaxyId**: *char[64]*)
- **Functional Dependencies:**
  - *ID -> MassType, Radius, Mass, GalaxyId*
  - *Mass -> MassType*

PlanetarySystem(<ins>**ID**: *char[64]*</ins>, **Type**: *char[64]*, **Age**: *integer*, **GalaxyId**: *char[64]*)
- **Functional Dependencies:**
  - *ID -> Type, Age, GalaxyId*

Asteroid(<ins>**ID**: *char[64]*</ins>, **Composition**: *char[64]*, **Type**: *char[64]*, **GalaxyId**: *char[64]*)
- **Functional Dependencies:**
  - *ID -> Composition, Type, GalaxyId*
  - *Composition -> Type*
  - *Type -> Composition*

Meteor(<ins>**ID**: *char[64]*</ins>, **PlanetEnteredID**: *char[64]*)
- **Functional Dependencies:**
  - *ID, PlanetID -> Mass*

Nebula(<ins>**ID**: *char[64]*</ins>, **Type**: *char[64]*, **Magnitude**: *integer*, **GalaxyId**: *char[64]*)
- **Functional Dependencies:**
  - *ID -> Type, Magnitude, GalaxyID*

Satellite(<ins>**ID**: *char[64]*</ins>, **PlanetId**: *char[64]*, **Mass**: *integer*)
- **Functional Dependencies:**
  - *ID, PlanetID -> Mass*

Moon(<ins>**ID**: *char[64]*</ins>, **Radius**: *integer*)
- **Functional Dependencies:**
  - *ID -> Radius*

Planet(<ins>**ID**: *char[64]*</ins>, **Declination**: *integer*, **Right Ascension**: *integer*, **Mass**: *integer*, **Radius**: *integer*, **Type**: *char[64]*, **planetarySystemId**: *char[64]*)
- **Functional Dependencies:**
  - *ID -> Declination, Right Ascension, Mass, Radius, Type, PlanetarySystemID*

Star(<ins>**ID**: *char[64]*</ins>, **Declination**: *integer*, **Right Ascension**: *integer*, **Type**: *char[64]*, **Mass**: *integer*, **Radius**: *integer*, **Temperature**: *integer*, **Luminosity**: *integer*, **planetarySystemId**: *char[64]*)
- **Functional Dependencies:**
  - *ID -> Declination, RightAscension, Mass, Radius, Type, PlanetarySystemID*
